$(window).load(function () {
    setTimeout(function(){ verificaAltura('imgReceita', true, 'divImgReceita'); }, 200);
    setTimeout(function(){ verificaAltura('tituloReceita'); }, 200);
});
$(document).ready(function () {
    setTimeout(function(){ verificaAltura('imgReceita', true, 'divImgReceita'); }, 200);
    setTimeout(function(){ verificaAltura('tituloReceita'); }, 200);
});
$(window).resize(function () {
    setTimeout(function(){ verificaAltura('imgReceita', true, 'divImgReceita'); }, 200);
    setTimeout(function(){ verificaAltura('tituloReceita'); }, 200);
});

function voltar(){
    $('html, body').animate({scrollTop: 0 }, 1000);
}

$(document).on('click', '.menuRetratil a', function () {
    document.getElementById("control-nav").checked = false;
});

$(document).on('click', '.clickMenu a', function () {
    var rel = $(this).attr('rel');
    if(rel != 'undefined' && rel != null){
        var alvo = $("#" + rel).offset().top;
        $('html, body').animate({scrollTop: alvo}, 1000);
    }
    
    if(rel == 'quem-somos'){
        mostraTextoQuemSomos();
    }
});

function mostraTextoQuemSomos(){
    $('.banner h1').css({"display":"none"});
    $('.textoQuemSomos').css({"opacity":"1"});
}

function verificaAltura(classe, menor = false, aplica = classe) {
    if (document.getElementsByClassName(classe) !== null) {
        var elementoConfere = document.getElementsByClassName(classe);
        var elementoAplica = document.getElementsByClassName(aplica);
        var tamanho = elementoConfere.length;
        var aplicante = 0;
        
        for (var i = 0; i < tamanho; i++) {
            elementoAplica[i].style.height = "auto";
        }

        for (var i = 0; i < tamanho; i++) {
            //console.log(elementoConfere[i].offsetHeight);
            if (i === 0) {
                aplicante = elementoConfere[i].offsetHeight;
            } else {
                if (menor) {
                    if (elementoConfere[i].offsetHeight < aplicante) {
                        aplicante = elementoConfere[i].offsetHeight;
                    }
                } else {
                    if (elementoConfere[i].offsetHeight > aplicante) {
                        aplicante = elementoConfere[i].offsetHeight;
                    }
                }
            }
        }

        for (var i = 0; i < tamanho; i++) {
            elementoAplica[i].style.height = aplicante + "px";
        }
    }
}

var query = location.search.slice(1);
var partes = query.split('&');
var data = {};
partes.forEach(function (parte) {
    var chaveValor = parte.split('=');
    var chave = chaveValor[0];
    var valor = chaveValor[1];
    data[chave] = valor;
});

if (data.pg) {
    var alvo = $("#receitas").offset().top;
    //console.log(alvo);
    $('html, body').animate({scrollTop: alvo}, 1000);
}

url = window.location.href;

if (url.indexOf("quem-somos") !== -1) {
    mostraTextoQuemSomos();
}