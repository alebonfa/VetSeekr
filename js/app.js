$(document).ready(function(){

    $('.selectpicker').selectpicker();

            /*
            var call = $.ajax({
                type: "POST",
                url: "php/getCidades.php",
                dataType: "json",
                async: false,
                success: function(result){
                    alert(result);
                }
            }).responseText;
            */

    var cidades = [];

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
});
