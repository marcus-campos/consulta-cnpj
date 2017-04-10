<table class="table">
        <tbody>
            <tr>
                <td width="60">Nome</td>
                <td width="60">CNPJ</td>
                <td width="60">Fantasia</td>
                <td width="60">UF</td>
                <td width="60">Telefone</td>
                <td width="60">Situação</td>
                <td width="60">Data situação</td>
                <td width="60">Logradouro</td>
                <td width="60">Número</td>
                <td width="60">Bairro</td>
                <td width="60">Município</td>
                <td width="60">CEP</td>
                <td width="60">Abertura</td>
                <td width="60">Natureza Jurídica</td>
                <td width="60">Ultima atualização</td>
                <td width="60">Status</td>
                <td width="60">Tipo</td>
                <td width="60">Complemento</td>
                <td width="60">Email</td>
                <td width="60">EFR</td>
                <td width="60">Motivo situação</td>
                <td width="60">Situação especial</td>
                <td width="60">Data situação especial</td>
                <td width="60">Capital social</td>
                <td width="60"></td>
                <td width="60">Atividade principal</td>
                <td width="60">Codigo</td>
                <td width="60"></td>
                <td width="60">Atividades secundarias</td>
                <td width="60">Codigo</td>
                <td width="60"></td>
                <td width="60">QSA</td>
                <td width="60">Codigo</td>
            </tr>
            @foreach($companies as $company)
                <?php $company = json_decode($company->data, true) ?>
                <tr>
                    <td>
                        {{ $company['nome'] }}
                    </td>
                    <td>
                        {{ $company['cnpj'] }}
                    </td>
                    <td>
                        {{ $company['fantasia'] }}
                    </td>
                    <td>
                        {{ $company['uf'] }}
                    </td>
                    <td>
                        {{ $company['telefone'] }}
                    </td>
                    <td>
                        {{ $company['situacao'] }}
                    </td>
                    <td>
                        {{ $company['data_situacao'] }}
                    </td>
                    <td>
                        {{ $company['logradouro'] }}
                    </td>
                    <td>
                        {{ $company['numero'] }}
                    </td>
                    <td>
                        {{ $company['bairro'] }}
                    </td>
                    <td>
                        {{ $company['municipio'] }}
                    </td>
                    <td>
                        {{ $company['cep'] }}
                    </td>
                    <td>
                        {{ $company['abertura'] }}
                    </td>
                    <td>
                        {{ $company['natureza_juridica'] }}
                    </td>
                    <td>
                        {{ $company['ultima_atualizacao'] }}
                    </td>
                    <td>
                        {{ $company['status'] }}
                    </td>
                    <td>
                        {{ $company['tipo'] }}
                    </td>
                    <td>
                        {{ $company['complemento'] }}
                    </td>
                    <td>
                        {{ $company['email'] }}
                    </td>
                    <td>
                        {{ $company['efr'] }}
                    </td>
                    <td>
                        {{ $company['motivo_situacao'] }}
                    </td>
                    <td>
                        {{ $company['situacao_especial'] }}
                    </td>
                    <td>
                        {{ $company['data_situacao_especial'] }}
                    </td>
                    <td>
                        {{ $company['capital_social'] }}
                    </td>
                    <td>

                    </td>
                    <td>
                        {{ $company['atividade_principal'][0]['text'] }}
                    </td>
                    <td>
                        {{ $company['atividade_principal'][0]['code'] }}
                    </td>
                    <td>

                    </td>
                    @for($x = 0; $x < 2; $x++)
                        @if($x < 1)
                            <td>
                                {{ isset($company['atividades_secundarias'][$x]['text']) ? $company['atividades_secundarias'][$x]['text'] : '' }}
                            </td>
                            <td>
                                {{ isset($company['atividades_secundarias'][$x]['code']) ? $company['atividades_secundarias'][$x]['code'] : '' }}
                            </td>
                            <td>

                            </td>
                            <td>
                                {{ isset($company['qsa'][$x]['nome']) ? $company['qsa'][$x]['nome'] : '' }}
                            </td>
                            <td>
                                {{ isset($company['qsa'][$x]['qual']) ? $company['qsa'][$x]['qual'] : '' }}
                            </td>
                        @else
                            </tr>
                            <tr>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    {{ isset($company['atividades_secundarias'][$x]['text']) ? $company['atividades_secundarias'][$x]['text'] : '' }}
                                </td>
                                <td>
                                    {{ isset($company['atividades_secundarias'][$x]['code']) ? $company['atividades_secundarias'][$x]['code'] : '' }}
                                </td>
                                <td>

                                </td>
                                <td>
                                    {{ isset($company['qsa'][$x]['nome']) ? $company['qsa'][$x]['nome'] : '' }}
                                </td>
                                <td>
                                    {{ isset($company['qsa'][$x]['qual']) ? $company['qsa'][$x]['qual'] : '' }}
                                </td>
                            </tr>
                        @endif
                    @endfor
                @endforeach
    </tbody>
</table>
