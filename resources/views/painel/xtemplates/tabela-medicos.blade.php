<script type="text/x-template" id="tabelamedicos">
    <div>
        <h2>Tabela médicos</h2>
        <div id="example-table">
        </div>
    </div>
</script>



<script type="text/x-template" id="painelmedico">
    <div>
        <div class="row">
            <form style="padding: 2em;" class="col s12 card-panel">
                <div class="row">
                    <div class="input-field col s12">
                        <input v-model="medico.nome" id="nome_medico" type="text" class="validate">
                        <label for="nome_medico">Nome do médico</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input v-model="medico.valor" id="valor_medico" type="text" class="validate">
                        <label for="valor_medico">Valor da consulta</label>
                    </div>
                    <div class="input-field col s6">
                        <select id="slct-especialidade" v-model="medico.especialidade">
                            <option value="" disabled selected>Escolha abaixo</option>
                            <option value="cardiologista">Cardiologista</option>
                            <option value="pneumologista">Pneumologista</option>
                            <option value="psiquiatra">Psiquiatra</option>
                        </select>
                        <label>Especialidade do médico</label>
                    </div>
                </div>
                <button @click.prevent="salvaMedico()" class="waves-effect waves-light btn">Salvar</button>
            </form>
        </div>
    </div>
</script>