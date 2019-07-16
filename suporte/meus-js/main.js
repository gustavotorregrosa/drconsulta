import Vue from 'vue';
import Inputmask from "inputmask";

var Tabulator = require("tabulator-tables");

var campoSelect;

Vue.component('tabelamedico', {
  data: function () {
    return {
      tabulator: null,
      tableData: [], 
    }
  },
  watch: {
    //update table if data changes
    tableData: {
      handler: function (newData) {
        this.tabulator.replaceData(newData);
      },
      deep: true,
    }
  },
  mounted() {
    // instantiate Tabulator when element is mounted
    let actionIcon = function(cell, formatterParams, onRendered){ 
      return "<i class='deletar far fa-trash-alt'></i>  &nbsp;&nbsp;&nbsp;<i class='editar fas fa-pen'></i>";
      };

      let meucomponente = this;
      this.tabulator = new Tabulator(this.$refs.table, {
      data: this.tableData, //link data to table
      reactiveData: true, //enable data reactivity
      layout:"fitDataFill",
      responsiveLayout:"hide",
      columns: [
        { title: "Nome do médico", field: "nome", width: 500 },
        { title: "Preço da consulta", field: "valor", align: "left", width: 100 },
        { title: "Especialidade", field: "especialidade", width: 200 },
        { title: "Ações", formatter: actionIcon, width:100, align:"center", 
        cellClick: function(e, cell){
            if(e.target.classList.contains('deletar')){
              meucomponente.$emit('deletarmedico', cell.getRow().getData());
            }

            if(e.target.classList.contains('editar')){
              meucomponente.$emit('editarmedico', cell.getRow().getData());
            }
            
          }
        },
      ],
    });



  },
  methods: {
    carregadados: function(dados){
      this.tabulator.replaceData(dados);
    }
  },
  template: '<div ref="table"></div>'
});

Vue.component('painelmedico', {
  template: "#painelmedico",
  props: ['medico'],
  methods: {
    salvaMedico: function () {
      this.$emit('salvamedico');
      
    }
  }
});


var meuApp = new Vue({
  el: '#meuApp',
  data: {
    medico: {
      nome: "",
      valor: "",
      especialidade: ""
    },
    tobedeleted: "",
    nomemedicodeletado: "",
    exibepainel: false

  },
  mounted(){
    this.carregamedicos();
  },

  methods: {

    resetSelect: function(){
      campoSelect.destroy();
      var elem = document.querySelector("#slct-especialidade");
      campoSelect = M.FormSelect.init(elem, {});
    },

    painelUpdate: function(mdc){
      this.medico.id = mdc.id;
      this.medico.nome = mdc.nome;
      this.medico.valor = mdc.valor;
      this.medico.especialidade = mdc.especialidade;
      this.exibepainel = true;
      setTimeout(() => {
        this.resetSelect();
      }, 100);

    },  
    deletamedico: function(){
      let idMedico = this.tobedeleted;
      let url = document.querySelector('meta[name="dominio"]').content;
      url += "/medico/deletar/" + idMedico;
      fetch(url, {
        method: 'delete',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }
      }).then(response => response.text()).then(resp => {
        M.toast({html: resp});
        this.carregamedicos();
      });
      

    },
    mdlDeletaMedico: function(mdc){
      this.tobedeleted = mdc.id;
      this.nomemedicodeletado = mdc.nome;
      let modal = document.querySelector("#mdl-deleta-medico");
      let instance = M.Modal.getInstance(modal);
      instance.open();
      
    },
    ativapainel: function(){
      this.limpamedico();
      this.exibepainel = true;
    },
    limpamedico: function(){
      this.medico.id = "";
      this.medico.nome = "";
      this.medico.valor = "";
      this.medico.especialidade = "";
    },
    salvamedico: function () {
      let url = document.querySelector('meta[name="dominio"]').content;
      url += "/medico/salvar";

      fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
            body: JSON.stringify(this.medico)
        }).then((resposta) => resposta.text()).then(resp => {
          M.toast({html: resp});
          this.carregamedicos();
        }).catch(function (error) {
            console.log('Request failure: ', error);
        });

    },

    carregamedicos: function(){
      let url = document.querySelector('meta[name="dominio"]').content;
      url += "/medico/listar";
      fetch(url, {
        method: 'GET',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }}).then(resp => resp.json()).then(data => {
          this.$refs.tabelamedico.carregadados(data);
          this.limpamedico();
          this.exibepainel = false;

        }).catch(error => { console.log(error) })
      
    }


  }
});

(function () {
  var selector = document.getElementById("valor_medico");
  var im = new Inputmask("currency");
  im.mask(selector);
})();

document.addEventListener('DOMContentLoaded', function () {
  var elem = document.querySelector("#slct-especialidade");
  campoSelect = M.FormSelect.init(elem, {});
});

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.modal');
  var instances = M.Modal.init(elems, {});
});


