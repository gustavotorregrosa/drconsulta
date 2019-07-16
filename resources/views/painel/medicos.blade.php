@extends('painel.layout')

@section('content')
<style>
    .slide-fade-enter-active {
        transition: all .3s ease;
    }

    .slide-fade-leave-active {
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }

    .slide-fade-enter,
    .slide-fade-leave-to

    /* .slide-fade-leave-active below version 2.1.8 */
        {
        transform: translateX(10px);
        opacity: 0;
    }
</style>

<div id="meuApp">

    <div id="tbl">
        <tabelamedico @editarmedico="painelUpdate" @deletarmedico="mdlDeletaMedico" ref="tabelamedico"></tabelamedico>
    </div>


    <button @click="ativapainel" class="btn-floating btn-large waves-effect waves-light btn-small right"><i class="fas fa-plus"></i></button>


    <transition name="slide-fade">
        <painelmedico v-show="exibepainel" @salvamedico="salvamedico" :medico="medico" style="margin-top: 5em;"></painelmedico>
    </transition>


    <div id="mdl-deleta-medico" class="modal">
        <div class="modal-content">
            <h4>Deletar médico</h4>
            <p>Deseja realmente deletar o médico <span> @{{nomemedicodeletado}} <span></p>
        </div>
        <div class="modal-footer">
            <button @click="deletamedico" class="modal-close waves-effect waves-green btn-flat red btn-small">Deletar</button>
        </div>
    </div>


</div>




@endsection


@section('java-script-adicional')
@component('painel.xtemplates.tabela-medicos')
@endcomponent
<script src=" {{ asset('js/painel/main.js') }}"></script>
@endsection