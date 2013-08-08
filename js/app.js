$(document).ready(function(){

    $("input#btnCadastrar").click(function(){
        if($("#Cadastro")[0].checkValidity()) {
            $.ajax({
                type: "POST",
                url: "signup.php",
                data: $("#Cadastro").serialize(),
                dataType: 'json',
                success: function(msg){
                    if (msg[0] == "success") {
                        alertSignupSuccess(msg[1]);
                    } else {
                        alertSignupError(msg[1]);
                    }
                }
            });
        } else {
            $("#sbmCadastrar").trigger("click");
        }
        
    });

    function alertSignupError(msg) {
        $("#alert_placeholder").html('<div class="alert alert-error" id="msgSignupError"></div>');
        $("#msgSignupError").html('<button type="button" class="close" data-dismiss="alert">x</button>');
        $("#msgSignupError").append('<strong>Atenção! </strong>' + msg);
    }

    function alertSignupSuccess(msg) {
        alert(msg);
        $("#alert_placeholder").html('<div class="alert alert-success" id="msgSignupSuccess"></div>');
        $("#msgSignupSuccess").html('<button type="button" class="close" data-dismiss="alert">x</button>');
        $("#msgSignupSuccess").append('<strong>Parabéns! </strong>' + msg);
    }


    var cidades = [];
    var $geoCidade = geoip_city();
    var $geoUf = geoip_region_name();

    $("#lblCidade").append($geoCidade + '-' + $geoUf);

    $('.selectpicker').selectpicker();

    $("#srcCidades").typeahead({
        source : function(query, process) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "./php/getCidades.php",
                cache: false,
                success: function(data) {
                    cidades = [];
                    _.each( data, function(item, ix, list) {
                        cidades.push(item.nome + '-' + item.uf);
                    });
                    process(cidades);
                }
            });
        }
    });

    // Geolocation

    function obterLocalizacao() {
        //Utilizando a biblioteca Modernizr, verificamos o suporte ao HTML5
        if(Modernizr.geolocation){
            navigator.geolocation.getCurrentPosition(locationSucesso, locationErro);
        }else{
            //Código executado quando o navegador não oferece suporte ao HTML5
            alert("Seu navegador não oferece suporte ao HTML5. Para visualizar o conteúdo desta página atualize-o.");
        }
    }

    $("#btnMyPosition").click(obterLocalizacao);

    function locationErro(err) {
        switch (err.code) {
            case 1 :
                var alertErro = "A permissão para obter a sua posição foi negada.";
            break;
            case 2 :
                var alertErro = "Não foi possível estabelecer uma conexão para obter a sua posição.";
            break;
            case 3 :
                var alertErro = "Tempo de requisição esgotado.";
            break;
            default :
                var alertErro = "Não foi possível obter sua posição.";
            }
        var codigoErro = err.code;
        var msg = "Ocoreu um erro! <br>";
        msg += "Erro código: " + codigoErro + "<br>";
        msg += "Alerta: " + alertErro;
        document.getElementById('msg').innerHTML = msg;
    }

    function locationSucesso(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        var informacoes = "Informações: <br>";
        informacoes += "Latitude:" + latitude + "<br>";
        informacoes += "Longitude:" + longitude +  "<br>";

        var latlng = new google.maps.LatLng(latitude, longitude);
        var geocoder = new google.maps.Geocoder();
        
        geocoder.geocode({'latLng': latlng}, function(results, status) {
            if (results[1]) {
                informacoes += "Endereço: " + results[1].formatted_address;
                alert("1 - " + informacoes);
                alert("Deu certo! " + results[1].formatted_address);
                alert("2 - " + informacoes);
            } else {
                alert("Geocoder falhou devido a " + status);
            }
        });

        alert("3 - " + informacoes);
        document.getElementById('msg').innerHTML = informacoes;
    }

});
