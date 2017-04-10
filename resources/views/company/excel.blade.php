<div class="row">
        <div class="col-xs-12">
            <div class="card-box product-detail-box">
                <div class="row">

                    <div class="col-sm-8">
                        <div class="product-right-info">
                            <h3><b>{{ $company['nome'] }}</b></h3>
                            <h5><b>{{ $company['cnpj'] }}</b></h5>
                            <hr/>

                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row m-t-30">
                    <div class="col-xs-12">
                        <h4><b>Informações:</b></h4>
                        <div class="table-responsive m-t-20">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td width="400">CNPJ</td>
                                        <td>
                                            {{ $company['cnpj'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="400">Fantasia</td>
                                        <td>
                                            {{ $company['fantasia'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>UF</td>
                                        <td>
                                            {{ $company['uf'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Telefone</td>
                                        <td>
                                            {{ $company['telefone'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Situação</td>
                                        <td>
                                            {{ $company['situacao'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Data situação</td>
                                        <td>
                                            {{ $company['data_situacao'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Logradouro</td>
                                        <td>
                                            {{ $company['logradouro'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Número</td>
                                        <td>
                                            {{ $company['numero'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bairro</td>
                                        <td>
                                            {{ $company['bairro'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Município</td>
                                        <td>
                                            {{ $company['municipio'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="400">CEP</td>
                                        <td>
                                            {{ $company['cep'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Abertura</td>
                                        <td>
                                            {{ $company['abertura'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Natureza Jurídica</td>
                                        <td>
                                            {{ $company['natureza_juridica'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ultima atualização</td>
                                        <td>
                                            {{ $company['ultima_atualizacao'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            {{ $company['status'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tipo</td>
                                        <td>
                                            {{ $company['tipo'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Complemento</td>
                                        <td>
                                            {{ $company['complemento'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>
                                            {{ $company['email'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>EFR</td>
                                        <td>
                                            {{ $company['efr'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Motivo situação</td>
                                        <td>
                                            {{ $company['motivo_situacao'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Situação especial</td>
                                        <td>
                                            {{ $company['situacao_especial'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Data situação especial</td>
                                        <td>
                                            {{ $company['data_situacao_especial'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Capital social</td>
                                        <td>
                                            {{ $company['capital_social'] }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row m-t-30">
                    <div class="col-xs-12">
                        <h4><b>Atividade principal:</b></h4>
                        <div class="table-responsive m-t-20">
                            <table class="table">
                                <tbody>
                                <tr class="success">
                                    <td>
                                        Código
                                    </td>
                                    <td>
                                        Descrição
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $company['atividade_principal'][0]['code'] }}
                                    </td>
                                    <td>
                                        {{ $company['atividade_principal'][0]['text'] }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row m-t-30">
                    <div class="col-xs-12">
                        <h4><b>Atividades secundárias:</b></h4>
                        <div class="table-responsive m-t-20">
                            <table class="table">
                                <tbody>

                                    <tr class="success">
                                        <td>
                                            Código
                                        </td>
                                        <td>
                                            Descrição
                                        </td>
                                    </tr>
                                    @foreach($company['atividades_secundarias'] as $activities)
                                        <tr>
                                            <td>
                                                {{ $activities['code'] }}
                                            </td>
                                            <td>
                                                {{ $activities['text'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row m-t-30">
                    <div class="col-xs-12">
                        <h4><b>Quadro de sócios e administradores:</b></h4>
                        <div class="table-responsive m-t-20">
                            <table class="table">
                                <tbody>
                                    <tr class="success">
                                        <td>
                                            Qualificação
                                        </td>
                                        <td>
                                            Nome
                                        </td>
                                    </tr>
                                    @foreach($company['qsa'] as $person)
                                        <tr>
                                            <td>
                                                {{ $person['qual'] }}
                                            </td>
                                            <td>
                                                {{ $person['nome'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div> <!-- end card-box/Product detai box -->
        </div> <!-- end col -->
    </div> <!-- end row -->
