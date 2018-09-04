

$(function () {
  // form cadastro
  $("#form-cadastro").submit(function (event) {
    event.preventDefault();

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
          $('.conteudoRetorno').html('ERRO: ' + returnedData["message"]);
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

  
  // mascara para o campo cpf
  $("#inputCpf").mask('000.000.000-00', { reverse: true });


  
  
});

// atualiza tabela de registro
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

// funcao ajax para editar registro
function editarRegistro(cpf) {
  var url = window.location.href;

  var url_script_php = url + "controllers/editar_registro.php";
  $.ajax({
    type: 'POST',
    url: url_script_php,
    data: "",
    dataType: 'json',
    success: function (data) {
      console.log(data);
      
    },
    error: function (data) {
      console.log(data);
      
    },
    complete: function () {
      // ao final da requisição...
    }
  });
}

// Remove registro da tabela no evento do click do icone de remoção
$(document).on("click", ".remove", function () {
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

