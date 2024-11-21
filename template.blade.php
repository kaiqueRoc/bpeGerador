<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bilhete de Passagem Eletrônico {{ title }}</title>
    <style>
        * {
            padding: 0;
            margin: 3px 0 0;
        }

        h3 {
            text-align: center;
            font-size: 12px;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            display: flex;
        }

        .column {
            flex: 1;
            position: relative;
            border-right: 3px solid rgb(200, 200, 200);
            margin-right: 10px;
            padding: 0 20px;
        }

        .column:last-child {
            border-right: none;
        }

        .column:nth-child(1) {
            flex: 0.8 !important;
            position: relative;
            border-right: 3px solid rgb(200, 200, 200);
            margin-right: 10px;
            padding: 0 20px;
        }

        .column:nth-child(2) {
            border-left: none;
            border-right: 4px dashed rgb(200, 200, 200);
            margin-left: -15px;
            flex: 0.7;
        }

        .column:nth-child(2)::after {
            content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='48' height='48'%3E%3Cpath d='M12 14.1181L9.68347 16.4346C9.88726 16.9145 10 17.4425 10 17.9967C10 20.2059 8.20914 21.9967 6 21.9967C3.79086 21.9967 2 20.2059 2 17.9967C2 15.7876 3.79086 13.9967 6 13.9967C6.55427 13.9967 7.08222 14.1095 7.56215 14.3133L9.87868 11.9967L4.21142 6.32948C3.43037 5.54843 3.43037 4.2821 4.21142 3.50105L4.91852 2.79395L12 9.87542L19.0815 2.79395L19.7886 3.50105C20.5696 4.2821 20.5696 5.54843 19.7886 6.32948L14.1213 11.9967L16.4379 14.3133C16.9178 14.1095 17.4457 13.9967 18 13.9967C20.2091 13.9967 22 15.7876 22 17.9967C22 20.2059 20.2091 21.9967 18 21.9967C15.7909 21.9967 14 20.2059 14 17.9967C14 17.4425 14.1127 16.9145 14.3165 16.4346L12 14.1181ZM6 19.9967C7.10457 19.9967 8 19.1013 8 17.9967C8 16.8922 7.10457 15.9967 6 15.9967C4.89543 15.9967 4 16.8922 4 17.9967C4 19.1013 4.89543 19.9967 6 19.9967ZM18 19.9967C19.1046 19.9967 20 19.1013 20 17.9967C20 16.8922 19.1046 15.9967 18 15.9967C16.8954 15.9967 16 16.8922 16 17.9967C16 19.1013 16.8954 19.9967 18 19.9967Z' fill='rgb(200, 200, 200)'/%3E%3C/svg%3E");
            position: absolute;
            right: -8px;
            top: 690px;
            width: 30px;
            height: 30px;
        }

        .column:nth-child(3) {
            flex: 1.2;
            padding: 0 8px !important;
        }

        .column ul {
            margin-top: 10px;
            padding-left: 5px;
            list-style: none;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 8px;
        }

        .column ul li {
            margin-bottom: 7px;
        }

        .agency {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
        }

        .road {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            margin-top: 10px;
        }

        .extras {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            margin-top: 10px;
            padding-top: 5px;
        }

        .extras p {
            margin: 2px 0;
        }

        .barCode {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            margin-top: 5px;
            display: flex;
            align-items: flex-start;
        }

        .barCode-height {
            height: 300px;
        }

        .barCode-height-left {
            height: 230px;
        }

        .barCode .passenger {
            margin-left: 10px;
        }

        .barCode .passenger-1 {
            margin-left: -290px;
        }

        .qrCde {
            margin-top: 10px;
        }

        .rate {
            margin-top: 70px;
            position: absolute;
            margin-left: 70px;
            display: grid;
            grid-template-columns: repeat(2, auto);
            grid-gap: 4px;
            font-size: 10px;
        }

        .rate .value {
            margin-left: 210px;
        }

        .value-mot {
            margin-left: 120px;
        }

        .payment {
            margin-top: 240px;
            margin-left: 70px;
            position: absolute;
            display: grid;
            grid-template-columns: repeat(2, auto);
            grid-gap: 4px;
        }

        .payment .value {
            margin-left: 198px;
        }

        .bpeQrCodePassenger {
            margin-top: 7px;
            border: 1px solid rgb(179, 179, 179);
            height: 120px;
        }

        .bpeQrCodePassenger {
            display: flex;
            align-items: center;
        }

        .bpeQrCodePassenger .content {
            margin-top: -20px;
            font-size: 13px;
        }

        .qrCodeEmbarque {
            margin-top: 8px;
            border: 1px solid rgb(179, 179, 179);
            height: 120px;
            width: 50%;
            margin-left: 100px;
            margin-right: auto;
            text-align: center;
        }

        .issuedInContingency {
            border: 1px solid rgb(179, 179, 179);
            margin-top: 10px;
            margin-bottom: -10px;
            height: 45px;
        }

        .barcode_img {
            transform: rotate(90deg);
            width: 300px;
            height: 60px;
            transform-origin: left top;
            -webkit-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            margin-left: 60px;
        }

        .barcode_img_second {
            transform: rotate(90deg);
            width: 230px;
            height: 60px;
            transform-origin: left top;
            -webkit-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            margin-left: 60px;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="column">
        <h3 style="margin-bottom: 5px;">Via Do Passageiro</h3>
        <p style="margin-top: -2px; margin-bottom: 10px; text-transform: uppercase; font-size: 13px; text-align: center; font-weight: bold;">
            Documento Auxiliar do Bilhete de Passagem Eletrônico
        </p>
        <div class="agency">
            <p style="font-weight: bold; font-size: 10px;"> {{ agencyHeader.corporateName }}</p>
            <div style="display: flex; justify-content: space-between;">
                <p style="order: 1; margin-bottom: 2px;">CNPJ: {{ agencyHeader.cnpj}} </p>
            </div>
            <p style="font-size: 10px;"> {{ agencyHeader.address}} </p>
        </div>
        <div class="road">
            <p style="font-weight: bold;"> {{ issuerHeader.corporateName }} </p>
            <div style="display: flex; justify-content: space-between;">
                <p style="order: 1;">CNPJ:  {{ issuerHeader.cnpj }} </p>
                <p style="order: 2;">IE:  {{ issuerHeader.ie }} </p>
                <p style="order: 3;">SAC:  {{ issuerHeader.sac }} </p>
            </div>
            <p style="font-size: 10px; padding-top: 2px;"> {{ issuerHeader.address }} </p>
        </div>
            <div class="issuedInContingency">
                <p style="text-align: center; text-transform: uppercase; font-weight: bold; margin-top: 7px;">Emitida em Contigência</p>
                <p style="text-align: center; font-size: 12px; margin-top: 1px">Pendente de autorização</p>
            </div>
        <div class="extras">
            <div style="display: flex; justify-content: space-between;">
                <p style="order: 1;">Viação: <b> {{ operator }} </b></p>
                <p style="order: 2;">Classe: <b> {{ class }} </b></p>
            </div>
            <p>Origem: <b> {{ origin }} </b></p>
            <p>Destino: <b> {{ destiny }} </b></p>
            <div style="display: flex; justify-content: space-between;">
                <p style="order: 1;">Data: <b> {{ date }} </b></p>
                <p style="order: 2;">Horário: <b> {{ time }} </b></p>
                <p style="order: 3;">Poltrona: <b> {{ seat }} </b></p>
                <p style="order: 4;">Plataforma: <b> {{ platform }} </b></p>
            </div>
            <p>Linha <b> {{ line }} </b></p>
            <div style="display: flex; justify-content: space-between;">
                <p style="order: 1;">Tipo de viagem: <b> {{ typeTravel }} </b></p>
                <p style="order: 2;">Prefixo: <b> {{ prefix }} </b></p>
            </div>
        </div>
        <div class="barCode barCode-height">
            <img class="barcode_img" src="data:image/png;base64,{{ barCode }}" alt="bar-code" />
            <div class="passenger-1">
                <p>Passageiro: <b> {{ passenger.name }} </b></p>
                <p>Documento: <b> {{ passenger.document}} </b></p>
                <p>Tipo de desconto: <b> {{ passenger.typeDiscount }} </b></p>
            </div>
            <div class="rate">
                <p>Tarifa</p>
                <p class="value"> {{ rate.value }} </p>
                <p>Pedágio</p>
                <p class="value"> {{ rate.toll }} </p>
                <p>Taxa de embarque</p>
                <p class="value"> {{ rate.departureTax }} </p>
                <p>Seguro obrigatório</p>
                <p class="value"> {{ rate.mandatoryInsurance }} </p>
                <p>Outros</p>
                <p class="value"> {{ rate.others }} </p>
                <p>Valor Total R$</p>
                <p class="value"> {{ rate.total }} </p>
                <p>Desconto</p>
                <p class="value"> {{ rate.discount }} </p>
                <p style="font-size: 12px;"><b>Valor a pagar R$</b></p>
                <p style="font-size: 12px;" class="value"><b> {{rate.amountToPay }} </b></p>
            </div>
            <div class="payment">
                <p>Forma de pagamento</p>
                <p class="value"> {{ rate.typePayment}} </p>
                <p>Valor pago R$ </p>
                <p class="value"> {{ rate.amountPaid }} </p>
                <p>Troco</p>
                <p class="value"> {{ rate.change }} </p>
            </div>
        </div>
        <div class="bpeQrCodePassenger">
            <img style="margin-right: 18px; margin-left: 18px" width="100" height="100" src={{ qrCodeBpeEmbarque }} alt="">
            <div class="content">
                <div style="display: flex; justify-content: space-between;">
                    <p style="order: 1; margin-right: -5px;">BP-e n° <b> {{ numberBpe }} </b> </p>
                    <p style="order: 2; margin-right: 50px;">Série: <b> {{ series }} </b></p>
                </div>
                <p>Protocolo de autorização: <b> {{ $authorizationProtocol }} </b></p>
                <p>Data de autorização: <b> {{ dateAuthorization }} </b></p>
                <p style="font-size: 9px;">Consulte pela chave de acesso em: <br>
                    {{ consultKeyAccess }} </p>
            </div>
        </div>
        <p style="font-size: 7px; margin-top: 5px;">Tributos Totais Incidentes (Lei Federal 12.741/2012)
            {{ tributes }} </p>
    </div>

    <div class="column">
        <h3 style="font-size: 15px; margin-bottom: 20px;">DIREITOS DO PASSAGEIRO*</h3>
        <ul>
            <li>RESOLUÇÃO ANTT Nº 4.282, DE 17 DE FEVEREIRO DE 2014.</li>
            <li>I - ser transportado com pontualidade, segurança, higiene e conforto;</li>
            <li>II - transportar, gratuitamente, até 30 (trinta) quilos de bagagem no bagageiro e 5 (cinco) quilos
                de volume no porta-embrulho;</li>
            <li>III - receber os comprovantes das bagagens transportadas no bagageiro e ser indenizado por extravio
                ou dano de bagagem transportada no bagageiro;</li>
            <li>IV - receber a diferença do preço da passagem em veículos de característica inferior às daquele
                contratado;</li>
            <li>V - receber, às expensas da transportadora, alimentação e pousada, nos casos de venda de mais de um
                bilhete de passagem para a mesma poltrona ou interrupção/retardamento da viagem, após 3 (três)
                horas, em razão de defeito, falha ou outro motivo de responsabilidade da transportadora;</li>
            <li>VI - receber da transportadora, em caso de acidente, imediata e adequada assistência;</li>
            <li>VII - optar, em caso de atraso por período superior a 1 (uma) hora, por: continuar a viagem em outra
                empresa às expensas da transportadora; ou receber de imediato o valor do bilhete de passagem, em
                caso de desistência; ou continuar a viagem, pela mesma transportadora, que deverá dar continuidade à
                viagem num período máximo de 3 (três) horas após a interrupção;</li>
            <li>VIII - remarcar o bilhete adquirido observado o prazo de um 1 (ano) de validade do bilhete a contar
                da data da primeira emissão. A partir de 3 (três) horas antes do início da viagem, é facultado à
                transportadora efetuar a cobrança de até 20% (vinte por cento) do valor da tarifa a título de
                remarcação;</li>
            <li>IX - Transferir o bilhete adquirido, exceto se o contrato de transporte dispuser de outra maneira,
                observado o prazo de 1 (um) ano de validade do bilhete a contar da data da primeira emissão;</li>
            <li>X - receber a importância paga no caso de desistência da viagem, desde que com antecedência mínima
                de 3 (três) horas em relação ao horário de partida constante do bilhete, facultado à transportadora
                o desconto de 5% (cinco por cento) do valor da tarifa;</li>
            <li>XI - estar garantido pelo Seguro de Responsabilidade Civil contratado pela transportadora;</li>
            <li>XII - não ser obrigado a adquirir seguro facultativo complementar de viagem;</li>
        </ul>
        <p style="font-size: 9px; font-family: Verdana, Geneva, Tahoma, sans-serif; font-style: italic;">* Válido
            para viagens interestaduais e internacionais, sob regulação da ANTT. Para viagens intermunicipais dentro
            do mesmo estado, consulte a empresa transportadora para mais informações.</p>
    </div>

    <div class="column">
        <h3 style="margin-bottom: 5px;">Via Do Motorista</h3>
        <p
                style="margin-top: -2px; margin-bottom: 8px; text-transform: uppercase; font-size: 13px; text-align: center; font-weight: bold;">
            BILHETE DE EMBARQUE</p>

        <div class="agency">
            <p style="font-weight: bold; font-size: 10px;"> {{ agencyHeader.corporateName }} </p>
            <div style="display: flex; justify-content: space-between;">
                <p style="order: 1; margin-bottom: 2px;">CNPJ:  {{ agencyHeader.cnpj}} </p>
            </div>
            <p style="font-size: 10px;"> {{ agencyHeader.address }} </p>
        </div>

        <div class="road">
            <p style="font-weight: bold;"> {{ issuerHeader.corporateName }} </p>
            <div style="display: flex; justify-content: space-between;">
                <p style="order: 1;">CNPJ:  {{ issuerHeader.cnpj }} </p>
                <p style="order: 2;">IE:  {{ issuerHeader.ie }} </p>
                <p style="order: 3;">SAC:  {{ issuerHeader.sac }} </p>
            </div>
            <p style="font-size: 10px; padding-top: 2px;"> {{ issuerHeader.address }} </p>
        </div>

        <div class="extras" style="margin-top: -1px">
            <div style="display: flex; justify-content: space-between;">
                <p style="order: 1; width: 100%; white-space: nowrap;">Viação: <b> {{ operator }} </b></p>
                <p style="order: 2; width: 100%; white-space: nowrap; padding-left: 8px">Classe: <b>  {{ class }} </b></p>
            </div>
            <p>Origem: <b> {{ origin }} </b></p>
            <p>Destino: <b> {{ destiny }} </b></p>
            <div style="display: flex; justify-content: space-between;">
                <p style="order: 1; width: 100%; white-space: nowrap;">Data: <b> {{ date }} </b></p>
                <p style="order: 2; width: 100%; padding-left: 7px; white-space: nowrap;">Horário: <b> {{ time }} </b></p>
                <p style="order: 3; width: 100%; white-space: nowrap;">Poltrona: <b> {{ seat }} </b></p>
                <p style="order: 4; width: 100%; white-space: nowrap;">Plataforma: <b> {{ platform }} </b></p>
            </div>
            <p>Linha <b> {{ line }} </b></p>
            <div style="display: flex; justify-content: space-between;">
                <p style="order: 1;">Tipo de viagem: <b> {{ typeTravel }} </b></p>
                <p style="order: 2;">Prefixo: <b> {{ prefix }} </b></p>
            </div>
            <p>Serviço: <b> {{ $service }} </b></p>
        </div>

        <div class="barCode">
            <img style="width: 80px; height: 80px;" src={{qrCodeBpeEmbarque}} alt="">
            <div class="passenger qrCde">
                <p>Passageiro: <b> {{ $passenger.name }} </b></p>
                <p>Documento: <b> {{ $passenger.document }} </b></p>
                <p>Tipo de desconto: <b> {{ $passenger.typeDiscount }} </b></p>
                <p>Localizador: <b> {{ $passenger.locator }} </b></p>
            </div>
        </div>

        <div class="barCode barCode-height-left">
            <img class="barcode_img_second" src="data:image/png;base64,{{ barCode }}" alt="bar-code" />
            <div class="rate" style="margin-top: 1px;">
                <p style="margin-left: 10px;">Tarifa</p>
                <p class="value-mot"> {{ rate.value}} </p>
                <p style="margin-left: 10px;">Pedágio</p>
                <p class="value-mot"> {{ rate.toll }} </p>
                <p style="margin-left: 10px;">Taxa de embarque</p>
                <p class="value-mot"> {{ rate.departureTax}} </p>
                <p style="margin-left: 10px;">Seguro obrigatório</p>
                <p class="value-mot"> {{ rate.mandatoryInsurance }} </p>
                <p style="margin-left: 10px;">Outros</p>
                <p class="value-mot"> {{ rate.others }} </p>
                <p style="margin-left: 10px;">Valor Total R$</p>
                <p class="value-mot"> {{ rate.total }} </p>
                <p style="margin-left: 10px;">Desconto</p>
                <p class="value-mot"> {{ rate.discount }} </p>
                <p style="font-size: 12px; margin-left: 10px; width: 100% !important;"><b>Valor a pagar R$</b></p>
                <p style="font-size: 12px;" class="value-mot"><b> {{ rate.amountToPay }} </b></p>
            </div>

            <div class="payment" style="margin-top: 160px;">
                <p style="margin-left: 18px; width: 100% !important; margin-top: 10px;">Forma de pagamento</p>
                <p class="value-mot" style="margin-left: 90px; margin-top: 12px;"> {{ rate.typePayment }} </p>
                <p style="margin-left: 18px;">Valor pago R$ </p>
                <p class="value-mot" style="margin-left: 90px;"> {{ rate.amountPaid }} </p>
                <p style="margin-left: 18px;">Troco</p>
                <p class="value-mot" style="margin-left: 90px;"> {{ rate.change }} </p>
            </div>
        </div>

            <div class="qrCodeEmbarque">
                <img style="width: 80px; height: 80px; display: inline; margin-left: 5px; margin-top: 5px;" src={{qrCodeBpeEmbarque}}
                     alt="">
                <p style="font-size: 12px; text-align: center; margin-top: -2px;">Utilize este código para
                    acessar a área de embarque  </p>
            </div>
        <p style="text-align: center; font-size: 13px; margin-top: 5px;"><b> {{ numberTicket }} </b></p>
    </div>
</div>
</body>
</html>
