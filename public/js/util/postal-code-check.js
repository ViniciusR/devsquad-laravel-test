/**
* Source: https://viacep.com.br
**/

$(document).ready(function() {

    function clean_form() {
        // Limpa valores do formulário de postal_code.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#ibge").val("");
    }
    
    //Quando o campo postal_code perde o foco.
    $("#postal_code").blur(function() {

        //Nova variável "postal_code" somente com dígitos.
        var postal_code = $(this).val().replace(/\D/g, '');

        //Verifica se campo postal_code possui valor informado.
        if (postal_code != "") {

            //Expressão regular para validar o postal_code.
            var validapostal_code = /^[0-9]{8}$/;

            //Valida o formato do postal_code.
            if(validapostal_code.test(postal_code)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#address").val("...");
                $("#city").val("...");
                $("#state").val("...");

                //Consulta o webservice viapostal_code.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ postal_code +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#address").val(dados.logradouro);
                        $("#city").val(dados.localidade);
                        $("#state").val(dados.uf);
                    } //end if.
                    else {
                        //postal_code pesquisado não foi encontrado.
                        clean_form();
                        alert("Postal code not found.");
                    }
                });
            } //end if.
            else {
                //postal_code é inválido.
                clean_form();
                alert("Invalid postal code.");
            }
        } //end if.
        else {
            //postal_code sem valor, limpa formulário.
            clean_form();
        }
    });
});