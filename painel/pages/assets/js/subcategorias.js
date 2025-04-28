function preenche_subcategoria(ativa, ativaC){
    if( $('#categoria').val() ) {
        var selected = '';
        $('#subcategoria').hide();
        $('.carregando').show();
        $.getJSON('subcategorias.ajax.php?search=',{cod_categoria: $('#categoria').val(), ativa: ativa, ajax: 'true'}, function(j){
            var options = '<option value="">Selecione uma subcategoria</option>';	
            for (var i = 0; i < j.length; i++) {
                if(ativa == j[i].cod_subcategoria && ativaC == $('#categoria').val()){selected = 'selected';}else{selected = '';}
                options += '<option value="' + j[i].cod_subcategoria + '" '+selected+'>' + j[i].subcategoria + '</option>';
            }	
            $('#subcategoria').html(options).show();
            $('.carregando').hide();
        });
    } else {
        $('#subcategoria').html('<option value="">-- Escolha uma categoria --</option>');
    }
}