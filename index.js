const puppeteer = require('puppeteer');
const fs = require('fs');
const infoBpe = require('./infoBpe.json');
const reqBpe = require('./rquestbpe.json');
const moment = require('moment');
const handlebars = require('handlebars');
const path = require('path');
const bwip = require('bwip-js');
const axios = require('axios');
const { log } = require('console');
require('dotenv').config();


async function createPdf(html) {
    const browser = await puppeteer.launch({
        headless: 'false',
        args: ['--no-sandbox', '--disable-setuid-sandbox'],
        executablePath: process.env.CHROME_BIN || null
    });

    const page = await browser.newPage();
    await page.emulateMediaType('screen');
    await page.setViewport({ width: 3560, height: 2980 });
    await page.setContent(html);

    const pdfBuffer = await page.pdf({ format: 'A4', landscape: true, printBackground: true });
    await browser.close();
    return pdfBuffer;
}

async function generateQrCode(text) {
    // if (text) {
        const buffer = await bwip.toBuffer({ bcid: 'qrcode', text: text, width: 19.7, height: 19.7 });
    return `data:image/png;base64,${buffer.toString('base64')}`;

    // }
}

async function generateBarCode(text) {
    const buffer = await bwip.toBuffer({ bcid: 'pdf417', text: text, scale: 3, height: 10, includetext: false, rotate: 'R' });
    return buffer.toString('base64');
}


async function mountObjectToHtml(response, emitParams) {
    const bpeInfo = response.daBpe;
    const partsUrl = bpeInfo.qrcodeBpe.split('/');
    const bpeUrl = partsUrl.length > 2 ? partsUrl.slice(0, 3).join('/') : undefined;
    const destinationTravel = await discoveryOriginAndDestiny(emitParams.origem, emitParams.destino);

    return {
        title: response.daBpe.numeroBpe,
        agencyHeader: {
            corporateName: bpeInfo.cabecalhoAgencia.razaoSocial,
            cnpj: bpeInfo.cabecalhoAgencia.cnpj,
            address: `${bpeInfo.cabecalhoAgencia.endereco}, ${bpeInfo.cabecalhoAgencia.numero}, ${bpeInfo.cabecalhoAgencia.bairro} - ${bpeInfo.cabecalhoAgencia.cidade}, ${bpeInfo.cabecalhoAgencia.uf}`,
            sac: bpeInfo.telefoneEmpresa
        },
        issuerHeader: {
            corporateName: bpeInfo.cabecalhoEmitente.razaoSocial,
            cnpj: bpeInfo.cabecalhoEmitente.cnpj,
            ie: bpeInfo.cabecalhoEmitente.inscricaoEstadual,
            sac: bpeInfo.telefoneEmpresa,
            address: `${bpeInfo.cabecalhoEmitente.endereco},  ${bpeInfo.cabecalhoEmitente.numero}, ${bpeInfo.cabecalhoEmitente.bairro} - ${bpeInfo.cabecalhoEmitente.cidade}, ${bpeInfo.cabecalhoEmitente.uf}`
        },
        operator: bpeInfo.cabecalhoEmitente.razaoSocial,
        class: bpeInfo.classe,
        origin: destinationTravel.origin,
        destiny: destinationTravel.destiny,
        data: moment(response.assento['@data']).format('DD-MM-YYYY'),
        time: moment(emitParams.departureDate).format('HH:mm'),
        seat: response.assento['@assento'],
        platform: response.daBpe.plataforma,
        line: bpeInfo.linha,
        typeTravel: bpeInfo.tipoServico,
        prefix: bpeInfo.prefixo,
        passenger: {
            name: response['@nome'],
            document: response['@documento'],
            typeDiscount: bpeInfo.tipoDesconto,
            locator: response['@localizador']
        },
        rate: {
            value: bpeInfo.tarifa,
            toll: bpeInfo.pedagio,
            departureTax: bpeInfo.taxaEmbarque,
            mandatoryInsurance: bpeInfo.seguro,
            others: bpeInfo.outros,
            total: bpeInfo.valorTotal,
            discount: bpeInfo.desconto,
            amountToPay: bpeInfo.valorPagar,
            typePayment: bpeInfo.formaPagamento,
            amountPaid: bpeInfo.valorFormaPagamento,
            change: bpeInfo.troco
        },
        numberBpe: bpeInfo.numeroBpe,
        series: bpeInfo.serie,
        authorizationProtocol: bpeInfo.protocoloAutorizacao,
        dateAuthorization: moment(bpeInfo.dataAutorizacao).format('DD/MM/YYYY HH:mm:ss'),
        consultKeyAccess: `${bpeUrl} ${bpeInfo.chaveBpe}`,
        tributes: bpeInfo.outrosTributos,
        service: response.assento['@servico'],
        numberTicket: bpeInfo?.acessoRodoviaria?.numeroBilheteEmbarque,
        contingency: bpeInfo.contingencia === 'false' ? undefined : true
    };
}

async function getByDestination(ids) {
    // let data = JSON.stringify({
    //     "ids": [
    //         ...ids
    //     ],
    //     "perPage": 5000
    // });

    // let config = {
    //     method: 'post',
    //     maxBodyLength: Infinity,
    //     url: 'http://luna-destination.development.onfly.local:9501/destination/cities', // COLOCAR URL DO DESTINATION DE DEV
    //     headers: {
    //         'Content-Type': 'application/json'
    //     },
    //     data: data
    // };

    // const response = await axios.request(config)
    return reqBpe.data
}

async function discoveryOriginAndDestiny(origin, destiny) {
    const destinationPopulate = { origin: null, destiny: null };
    const destinations = await getByDestination([origin, destiny]);

    if (destinations.data && destinations.data.length) {
        destinationPopulate.origin = destinations.data.find(destination => destination.id === origin)?.displayName;
        destinationPopulate.destiny = destinations.data.find(destination => destination.id === destiny)?.displayName;
    }
    return { origin: destinationPopulate?.origin ?? origin, destiny: destinationPopulate?.destiny ?? destiny };
}

async function mountHtml(infoBpe, emitParams) {

        const html = fs.readFileSync(path.join( 'template.blade.php'), 'utf-8');
        const templateCompiled = handlebars.compile(html);
        const qrCodeBpe = await generateQrCode(infoBpe.daBpe.qrcodeBpe);

        const qrCodeNumberTicketBoarding = await generateQrCode(infoBpe.daBpe.acessoRodoviaria?.numeroBilheteEmbarque);

        const qrCodePassenger = await generateQrCode(infoBpe.daBpe.qrcode);
        const barCode = await generateBarCode(infoBpe.daBpe.qrcode);
        const infoGeneratesBpe = await mountObjectToHtml(infoBpe, emitParams);

    return templateCompiled({
            ...infoGeneratesBpe,
            qrCodeBpeEmbarque : qrCodeBpe,
            barCode,
            qrCodeEmbarque: qrCodeNumberTicketBoarding,
            qrCodePassenger
        });


}

(async () => {
    const emitParams = {
        origem: infoBpe.from,
        destino: infoBpe.to,
        departureDate: `${infoBpe.assento['@data']} ${infoBpe.timeLuna}`,
        reserveId: '8fb3d8d0-b8e1-4137-8e44-d0f02a6fc6ca'
    }
    const htmlMounted = await mountHtml(infoBpe, emitParams);
    const bufferPdf = await createPdf(htmlMounted);
    const fileName = `bus/bpe/${emitParams.reserveId}-${infoBpe['@localizador']}.pdf`;
    const optionsPdf = { ContentDisposition: 'inline', ContentType: 'application/pdf' };

    fs.writeFileSync(fileName, bufferPdf);
})();