

$(function () {  
  // mascara para o campo cpf
  $("#inputCpf").mask('000.000.000-00', { reverse: true });


  // url web service dos estados
  var url_webService_uf = "http://www.geonames.org/childrenJSON?geonameId=3469034";
  var optionsUf = "<option selected>Escolha Seu Estado</option>";

  /* Ajax consumindo o webservice e atualizando a lista de estados*/
  $.ajax({
    type: "POST",
    url: url_webService_uf,
    dataType: "json",
    success: function (data) { /* sucesso */
      data.geonames.forEach(element => {
        optionsUf += "<option value='" + element.toponymName + "'>" + element.toponymName + "</option>";
        
      });

      $("#selectUF").html(optionsUf); 
      $("#selectUFEdit").html(optionsUf); 

    }
  });
  
});

// atualiza a tabela html de registro
function atualizaTabela() {

  var url = window.location.href;
  url = url.split("/"); //quebra o endeço de acordo com a / (barra)
  var url_script_php = "http://" + url[2] + "/" + url[3] + "/controllers/registros_cadastrados.php";


  /* Ajax */
  $.ajax({
    type: "POST",
    url: url_script_php,
    async: true,
    data: "", 
    dataType: 'json',
    success: function (data) { /* sucesso */
      if (data.success) {  
        $('.table tbody').html(data.message);
      }
    },
    beforeSend: function () { /* antes de enviar */
      
    },
    complete: function () { /* completo */
      
      
    }
  });
}


// Submit do form de cadastro
$(document).on("submit", "#form-cadastro", function (event) {
  event.preventDefault();

  console.log($("#selectUF").val());
  

  var url = window.location.href;
  url = url.split("/"); //quebra o endeço de acordo com a / (barra)
  var url_script_php = "http://" + url[2] + "/" + url[3] + "/controllers/cadastrar_registro.php";


  /* Ajax */
  $.ajax({
    type: "POST",
    url: url_script_php,
    async: true,
    data: $(this).serialize(),
    dataType: "json",
    success: function (data) { /* sucesso */

      if (data.success) {
        $('.retornoForms').addClass('alert-success');
        $('.conteudoRetorno').html('Cadastrado com sucesso');
        atualizaTabela();

      } else {

        $('.retornoForms').removeClass('alert-success');
        $('.retornoForms').addClass('alert-danger');
        $('.conteudoRetorno').html('ERRO: ' + data.message);
        $('.retornoForms').fadeIn('fast');
      }

    },
    beforeSend: function () { /* antes de enviar */
      $('.retornoForms').removeClass('alert-danger');
      $('.retornoForms').addClass('alert-success');
      $('.conteudoRetorno').html('Enviando ...');
      $('.retornoForms').css("display", "block");
    },
    complete: function () { /* completo */
      $('#form-cadastro')[0].reset();
      setTimeout(() => {
        $('.retornoForms').css("display", "none");
      }, 5000);
    }
  });
});

// Submit do form de edição
$(document).on("submit", "#form-edita-registro", function (event) {
  event.preventDefault();

  var url = window.location.href;
  url = url.split("/"); //quebra o endeço de acordo com a / (barra)
  var url_script_php = "http://" + url[2] + "/" + url[3] + "/controllers/editar_registro.php";


  /* Ajax */
  $.ajax({
    type: "POST",
    url: url_script_php,
    async: true,
    data: $(this).serialize(),
    dataType: "json",
    success: function (data) { /* sucesso */

      if (data.success) {
        $('.retornoForms').addClass('alert-success');
        $('.conteudoRetorno').html('Editado com sucesso');
        atualizaTabela();
        $('#modalEditarRegistro').modal('hide');


      } else {

        $('.retornoForms').removeClass('alert-success');
        $('.retornoForms').addClass('alert-danger');
        $('.conteudoRetorno').html('ERRO: ' + data.message);
        $('.retornoForms').fadeIn('fast');
      }

    },
    beforeSend: function () { /* antes de enviar */
      $('.retornoForms').removeClass('alert-danger');
      $('.retornoForms').addClass('alert-success');
      $('.conteudoRetorno').html('Editando ...');
      $('.retornoForms').css("display", "block");
    },
    complete: function () { /* completo */
      $('#form-cadastro')[0].reset();
      setTimeout(() => {
        $('.retornoForms').css("display", "none");
      }, 5000);
    }
  });
});

// Preenche modal com dados do registro que será editado
$(document).on("click", ".edita", function () {
  // e.preventDefault();
  var cpf = $(this).attr("cod");

  var url = window.location.href;
  url = url.split("/"); //quebra o endeço de acordo com a / (barra)
  var url_script_php = "http://" + url[2] + "/" + url[3] + "/controllers/dados_registro_edicao.php";

  /* Ajax */
  $.ajax({
    type: "POST",
    url: url_script_php,
    data: { 'cpf': cpf },
    dataType: "json",
    success: function (data) { /* sucesso */
      console.log(data);
      

      if (data.success) {
        
          // Reseta o form para evitar conflitos, preenche os campos e chama o modal
          $('#form-edita-registro')[0].reset();
          $('#inputNomeEdit').val(data.nome);
          $('#inputCpfEdit').val(data.cpf);
          $('#cpfParaEditar').val(data.cpf);
          $('#inputDataNascEdit').val(data.dataNascimento);
          $('#inputPesoEdit').val(data.peso);
          $('#selectUFEdit').val(data.uf);
          $('#modalEditarRegistro').modal('show');

      } 

    }
  });
});

// Remove registro da tabela no evento do click de confirmação do modal
$(document).on("click", "#removerRegistro", function () {
  // e.preventDefault();
  
  var cpf = $(this).attr("cod");

  var url = window.location.href;
  url = url.split("/"); //quebra o endeço de acordo com a / (barra)
  var url_script_php = "http://" + url[2] + "/" + url[3] + "/controllers/deletar_registro.php";

  /* Ajax */
  $.ajax({
    type: "POST",
    url: url_script_php,
    data: { 'cpf': cpf },
    dataType: "json",
    success: function (data) { /* sucesso */


      if (data.success) {
        $('.retornoForms').addClass('alert-success');
        $('.conteudoRetorno').html('Removido com sucesso');
        atualizaTabela();
        $('#modalConfirmaExclusao').modal('hide');


      } else {

        $('.retornoForms').removeClass('alert-success');
        $('.retornoForms').addClass('alert-danger');
        $('.conteudoRetorno').html('ERRO: ' + data.message);
        $('.retornoForms').fadeIn('fast');
      }

    },
    beforeSend: function () { /* antes de enviar */
      $('.retornoForms').removeClass('alert-danger');
      $('.retornoForms').addClass('alert-success');
      $('.conteudoRetorno').html('Deletando ...');
      $('.retornoForms').css("display", "block");
    },
    complete: function () { /* completo */
      $('#form-cadastro')[0].reset();
      setTimeout(() => {
        $('.retornoForms').css("display", "none");
      }, 5000);
    }
  });
});

// abre o modal de confirmação de exclusão
$(document).on("click", ".remove", function () {

  var cod = $(this).attr("cod");
  $("#removerRegistro").attr("cod", cod);
  
  $('#modalConfirmaExclusao').modal('show');

});

