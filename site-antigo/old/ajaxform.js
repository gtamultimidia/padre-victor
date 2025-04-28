var isIE = /*@cc_on!@*/false; //vendo se � o IE

/* TESTAR V�RIOS ERROS HTTP
por pra funcionar styles no IE e flash */


function ajaxGo(param){
/**
* ajaxGo - envia uma solicita��o ajax simples ou submete um formul�rio via ajax
* sintaxe: ajaxGo({ url | form [, elem_return] [, timeout] [, loading] [, callback] [, unescape] [, hide_err]})
* Vers�o: 1.0 - 28/12/2007
* Autores: Micox - www.elmicox.com - elmicox.blogspot.com
* 		   Klawdyo - Jos� Cl�udio
* Licen�a: Creative Commons - http://creativecommons.org/licenses/by/2.5/br/
* Some Rights Reserved - http://creativecommons.org/licenses/by/2.5/
**/

    /******** declaracao de variaveis ********/    
    var url, the_form, callback, timeout, html_loading='', elem_return, unescape_, hide_err; //vars que receber�o os parametros da funcao
    var concat, url_orig, msg, timeload, timeout, ajax; //outras vari�veis
    var method='GET', query='', loadpos=0, timecounter=0, self=this; //vari�veis inicializadas
    var loads = [':::','|::',':|:','::|']; //animacao do loading

    
    /******** pegando os parametros obrigatorios ********/    
    if(!param.url && !param.form){//pelo menos 1 dos 2 argumentos deve ser obrigat�rio
        alert('Programador, reveja sua chamada ao ajaxGo.\r\nVoc� deve informar pelo menos a "url" ou o "form".');
        return false;
    }
    if(param.url){ url = param.url; }
    if(param.form){
        if(param.form.constructor==String){ //id do form passada
            the_form = document.getElementById(param.form);            
        }else if(typeof(param.form.nodeType)!='undefined'){ //form passado como referencia ao objeto html
            the_form = param.form;
        }
        if(the_form && the_form.nodeName.toLowerCase()=='form'){//se o elemento existe e � realmente um form
            if(!url) { url = the_form.action; }
            if(the_form.method) { method = the_form.method.toUpperCase();}
            
        }else{ //form n�o existe
            alert('Programador, reveja sua chamada ao ajaxGo.\r\nO form "' + url_ou_form + '" informado, nao existe');
            return false;
        }
        
    }
    //pegando os parametros opcionais.
    if(param.callback){ callback = param.callback; }
    if(param.timeout){ timeout = param.timeout; }
    if(param.loading){ html_loading = param.loading; }
    if(param.unescape){ unescape_ = param.unescape;}
    if(param.hide_err){ hide_err = param.hide_err;}
    if(param.elem_return){
        if(param.elem_return.constructor==String){
            elem_return = document.getElementById(param.elem_return);
        }else if(typeof(param.elem_return.nodeType)!='undefined'){ //elemento passado como referencia ao objeto html
            elem_return = param.elem_return;
        }
        
        if(!elem_return){
            alert('Programador, reveja sua chamada ao ajaxGo.\r\nO elem_return "' + arguments[1] + '" informado, nao existe');
            return false;
        }
    }
    
    /******** come�ando o ajax ********/    
    ajax = getAjax(); //capturando um NOVO objeto xmlHttpRequest
    if(ajax){    
        if(the_form){    query = getFieldsForm(the_form); }
        //montando a URL
        url_orig = url;
        concat = (url.indexOf('?')>=0) ? "&" : '?';
        //antiga antiCacheRand. Para o problema de cache com ajax do IE
        if(isIE){
            dt = new Date();
            url += concat + encodeURI(dt.getTime());
            concat = '&';
            delete dt;
        }
        
        ajax.onreadystatechange = ajaxOnReady;
        try{
			if(method=='GET'){
				query = query.substr(0,2030); //IE limits http://classicasp.aspfaq.com/forms/what-is-the-limit-on-querystring/get/url-parameters.html
				ajax.open(method, url + concat + query ,true)
				ajax.setRequestHeader("Content-Type", "text/html; charset=utf-8");
				ajax.setRequestHeader("Content-length", query.length);
				query='';
				
			}else{ //POST
				ajax.open(method, url ,true);
				ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				ajax.setRequestHeader("Content-length", query.length);         
			}
			ajax.setRequestHeader('X-Requested-With', 'ajax'); //dizendo ao servidor que foi pedido via ajax. Recupera-se com $_SERVER['X-Requested-With'] (no php)
			ajax.setRequestHeader("Cache-Control", "no-cache");
			ajax.setRequestHeader("Pragma", "no-cache");
			query = query.replace(/\+/g, "char(mais)");
			//query = query.replace(/\&/g, "char(ecom)");
			ajax.send(query);
        }catch(e){
			var e_men = "Programador, verifique se a url "+ url +"  � v�lida e est� em seu dom�nio."
			if(isIE) { e_men = e.description + "\r\n\r\n" + e_men }
			else{ e_men = e + "\n\n" + e_men }
			alert(e_men)
			return;
		}
        
        //fun��o peri�dica que verifica o timeout e gera anima��o
        timeload = setInterval(periodic,250);
        
        return true;
        
    }else{
        return false;
    }


    /******** fun��es extra que ser�o chamadas    ****************/
    
    function ajaxOnReady(){ //executada a cada altera��o no status http
    
        if(timeout && timecounter/4 > timeout){ //estourou o timeout. O abort() foi feito na funcao periodic()
            clearInterval(timeload); //fim do contador
            msg = "Falha no carregamento. Tempo limite excedido: " + timeout + ' segs.';
            if(!hide_err){ put(msg); }
            window.status = '';
            if(callback){ callback(msg); } //chamando a fun��o de callback

            ajax = null; delete ajax; delete self; 
            return false;
            
        }
        
        /* o readystate=2 status!=200 mata o ajax, mas alguns navegadores ainda chamam o onready sem ter ajax */
        if(!ajax) { return }
                
        if(ajax.readyState==4){ //carregamento (ou n�o carregamento) completo
            clearInterval(timeload); //fim do contador
            if(ajax.status == 200){ //com sucesso
                var texto=ajax.responseText;
                if(texto.indexOf(" ")<0) texto=texto.replace(/\+/g, " ");
                if(unescape_==true){ //se tiver usado o urlencode no php ou asp
                    texto=unescape(texto);
                }
                put(texto);
                getScripts(texto);
                if(isIE){ getStyles(texto) }
                window.status = '';
                if(callback){ callback(texto); } //chamando a fun��o de callback
            }else{ //com erro
                msg = "Falha no carregamento. " + httpStatus(ajax.status);
                if(!hide_err){
                    if(html_loading){                    
                        put(msg);
                    }else{
                        window.status = msg;
                    }
                }
                if(callback){ callback(msg); } //chamando a fun��o de callback
            }
			ajax = null; delete ajax; delete timeload;
			delete self; return;
            
        }else if(ajax.readyState==2 && typeof(ajax.status)!='unknown'){ //n�o tava pegando o erro 404 no readystate==4
			if(ajax.status != 200){
				clearInterval(timeload); //fim do contador
				msg = "Falha no carregamento. " + httpStatus(ajax.status);
				if(!hide_err){
					if(html_loading){                    
						put(msg);
					}else{
						window.status = msg;
					}
				}
				if(callback){ callback(msg); } //chamando a fun��o de callback
				ajax = null; delete ajax; delete timeload;
				delete self; return;
             }else{
				window.status = '';
			}
        }else{//para mudar o status de cada carregando
            window.status = '';
        }
    }
    function loadsAnim(){ //faz a anima��ozinha no array loads
        if(html_loading.indexOf('<img')<0){ // 3 dots just if no image
            if(loadpos>loads.length - 1){ loadpos = 0; }
            return loads[loadpos++] + ' ';
        }else{ return '';}        
    }
    function put(valor){ //coloca o valor no elemento de retorno, se houver este
        if(elem_return){
            if(elem_return.nodeName.toLowerCase()=="input"){
                valor = escape(valor).replace(/\%0D\%0A/g, ""); //sumindo com o enter
                elem_return.value = unescape(valor);
            }else if(elem_return.nodeName.toLowerCase()=="select"){
				//if no have options, put in option and strip other tags
				if(valor.indexOf('<option')<0){ valor = '<option>' + valor.replace(/<\/?[^>]+>/gi, '') + '</option>' }
                if(isIE){
                	select_innerHTML(elem_return, valor.replace(/&nbsp;/g,' '));
                }else{
					select_innerHTML(elem_return, valor)
                }
            }else if(elem_return.nodeName){
                elem_return.innerHTML = valor;
            }  
        }
    }
    function periodic(){ //fun��o executada periodicmente pra fazer anima��o e testar timeout
        //mensagem indicando o carregamento
        if(html_loading){
            put(html_loading + loadsAnim() )
        }else{
            window.status = 'Carregando ' + url_orig + loadsAnim();
        }
        
        //fazendo o contador
        timecounter++; //contador que incrementa-se a cada 1/4 de segundo
        if(timecounter/4 > timeout){ //estourou o timeout
            clearInterval(timeload); //fim do contador
            ajax.abort(); //tamb�m dispara a ajaxOnReady (no opera n�o dispara o ajaxonready())
            if(ajax){ ajaxOnReady() } //se o ajaxOnReady n�o foi chamado no abort() acima, eu chamo na m�o
        }

    }
    function getAjax(){ //instancia um novo xmlhttprequest    
        //baseado na getXMLHttpObj que possui muitas c�pias na net e eu nao sei quem � o autor original
        if(typeof(XMLHttpRequest)!='undefined'){return new XMLHttpRequest();}
        var axO=['Microsoft.XMLHTTP', 'Msxml2.XMLHTTP','Msxml2.XMLHTTP.6.0','Msxml2.XMLHTTP.4.0','Msxml2.XMLHTTP.3.0'];
        for(var i=0;i<axO.length;i++){ try{ return new ActiveXObject(axO[i]);}catch(e){} }
        return null;
    }
    function httpStatus(stat){ //retorna o texto do erro http
        switch(stat){
            case 0: return "Erro desconhecido de javascript. " + ajax.statusText;
            case 400: return "400: Solicitacao incompreensivel";
            case 403: case 404: return "404: Nao foi encontrada a URL solicitada " + url;
            case 405: return "405: O servidor nao suporta o metodo solicitado";
            case 500: return "500: Erro desconhecido do servidor";
            case 503: return "503: Capacidade maxima do servidor alcancada";
            default: return "Erro HTTP " + stat + ': ' + ajax.statusText + ". Informacoes em http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html";
        }
    }
    
}

function select_innerHTML(objeto,innerHTML){
/******
* select_innerHTML - corrige o bug do InnerHTML em selects no IE
* Veja o problema em: http://support.microsoft.com/default.aspx?scid=kb;en-us;276228
* Vers�o: 2.3 - 04/03/2008 - By Micox - elmicox.blogspot.com
*******/

	if(!isIE){ objeto.innerHTML = innerHTML; return true; } //normal browsers

    var opt, selTemp = document.createElement("micoxselect");    
    objeto.innerHTML = ""; selTemp.id="micoxselect1";
    document.body.appendChild(selTemp);
    selTemp = document.getElementById("micoxselect1");
    selTemp.style.display="none";
    
    if(innerHTML.toLowerCase().indexOf("<option")<0){//se n�o � option eu converto
        innerHTML = "<option>" + innerHTML + "</option>" }
    
    innerHTML = innerHTML.toLowerCase().replace(/<option/g,"<span").replace(/<\/option/g,"</span");
    selTemp.innerHTML = innerHTML;
    
    for(var i=0;i<selTemp.childNodes.length;i++){
        var spantemp = selTemp.childNodes[i];
        
        if(spantemp.tagName){    
            opt = document.createElement("OPTION");            
            if(isIE){ objeto.add(opt); }else{ objeto.appendChild(opt);  }      
            
            //getting attributes
            for(var j=0; j<spantemp.attributes.length; j++){
                var attrName = spantemp.attributes[j].nodeName;
                var attrVal = spantemp.attributes[j].nodeValue;
                if(attrVal){ try{
                        opt.setAttribute(attrName,attrVal);
                        opt.setAttributeNode(spantemp.attributes[j].cloneNode(true));
                    }catch(e){}
                }
            }
            //getting styles
            if(spantemp.style){ for(var y in spantemp.style){
                    try{opt.style[y] = spantemp.style[y];} catch(e) {}
            } }
            
            //value and text
            opt.value = spantemp.getAttribute("value");
            opt.text = spantemp.innerHTML;
            opt.selected = spantemp.getAttribute('selected'); //IE
            opt.className = spantemp.className; //IE
        }
    }    
    document.body.removeChild(selTemp); selTemp = null;
}
function getScripts(texto){ //extrai javascripts do texto e executa no documento
//Author: SkyWalker.TO do imasters/forum (pequenas altera��es by Micox)
    var ini = 0;
    // loop enquanto achar um script
    while (ini!=-1){
        ini = texto.indexOf('<script', ini);
        if (ini >=0){
            ini = texto.indexOf('>', ini) + 1;
            // procura o final do script
            var fim = texto.indexOf("<\/script>", ini);
            codigo = texto.substring(ini,fim);
            // executa o script - alterado by Micox.
            var novo = document.createElement("script")
            novo.text = codigo; novo.type = 'text/javascript';
			document.body.appendChild(novo);
        }
    }
}

function getStyles(texto){
	//Parse styles on IE. Ver. 1.0 - 25/03/08 - by Micox - elmicox.blogspot.com
    var ini = 0;
    while (ini!=-1){
        ini = texto.indexOf('<style', ini);
        if (ini >=0){
            ini = texto.indexOf('>', ini) + 1;
            var fim = texto.indexOf("<\/style>", ini);
            codigo = texto.substring(ini,fim);
            // executa o style 
			var rules = codigo.split('}')
			var rule, selector, style;
			for(var i=0; i<rules.length-1 ; i++){
				rule = rules[i].split('{')
				selector = rule[0].trim()
				style = rule[1].trim()	
				document.styleSheets[document.styleSheets.length-1].addRule(selector,style)
			}
        }
    }
}

String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,'');
} 
function selectDinamico(este_select,select_alvo,url_trata){
	//facilita a cria��o de selects dinamicos com ajax.
	//by Micox - elmicox.blogspot.com
	select_alvo = document.getElementById(select_alvo)
	var nparam = este_select.name ? este_select.name : este_select.id
	var val = este_select.options[este_select.selectedIndex].value
	var conc = (url_trata.indexOf('?')>=0) ? "&" : '?';
	url_trata = url_trata + conc + encodeURI(nparam) + "=" + encodeURI(val)
	//a fun��o ajax que trata � a ajaxGo mas pode ser alterado
	ajaxGo({ url: url_trata, elem_return: select_alvo, loading: 'Carregando'})
}

function getFieldsForm(fform){ //pega campos do formul�rio e retorna a querystring correspondente
/* Autor: Jos� Cl�udio Medeiros de Lima (pequenas altera��es by Micox - 28/12/07)
* url: http://forum.ievolutionweb.com/index.php?showtopic=18264
* Vers�o: 1.5 - 28/12/2007 - Creative Commons */
    var buff = [];
    for (var i=0; i< fform.length;i++)  {
        var campo = fform.elements[i];
        if((campo.type=="checkbox" || campo.type=="radio")){
            if(campo.checked==true && campo.name){
                buff.push(campo.name + "=" + encodeURI(campo.value));
            }
        }else if(campo.name){ //campos que n�o tenham name n�o v�o.
            buff.push(campo.name + "=" + encodeURI(campo.value));
        }
    }
    return buff.join("&");
}

/* Abaixo ativa a configura��o via classes e target. 
   � s� colocar a classe "micoxajax" nos links e forms que quer submetidos via ajax
   e indicar o alvo no target do mesmo elemento.
   Ex: <a href='site.htm' class='micoxajax' target='mydiv'>  */
function ativaMicoxAjax(){
	var links = document.getElementsByTagName('a')
	for(var i=0; i<links.length ; i++){
		if(links[i].className.search('\\bmicoxajax\\b')>-1){
			links[i].onclick = function(ev){
				if(!ev) { ev = window.event }
				var params = getParamsX(this)
				ajaxGo( params )
				params = null; delete params;
				if(ev.preventDefault) { ev.preventDefault()}
				ev.returnValue=false
				return false;
			}
		}
	}
	var formas = document.getElementsByTagName('form')
	for(var i=0; i<formas.length ; i++){
		if(formas[i].className.search('\\bmicoxajax\\b')>-1){
			formas[i].onsubmit = function(ev){
				if(!ev) { ev = window.event }
				var paramsf = getParamsX(this)
				ajaxGo( paramsf )
				paramsf = null; delete paramsf;
				ev.preventDefault; ev.returnValue=false
				return false;
			}
		}
	}
	function getParamsX(quem){
		var param_= {} 
		if(quem.href){ param_.url = quem.href }
		if(quem.action){ param_.form = quem }
		if(quem.target){ param_.elem_return = quem.target }
		if(quem.className.search('\\bloading\\b')>-1){ //s� mensagem de loading default
			param_.loading = "Carregando"
		}
		if(quem.className.search('\\bloading\\[(.+)\\]')>-1){
			param_.loading = quem.className.match('\\bloading\\[(.+)\\]')[1]
			param_.loading = param_.loading.replace(/_/g,' ')
		}
		return param_;
	}
}
function bodyOnReady(func){
 /* call the function 'func' when DOM loaded
 Version 2.0 - by Micox - 03/03/2008 - based on Jquery bindReady
 elmicox.blogspot.com/2007/11/evento-body-onready-sem-o-uso-de-libs_14.html */
	if(document.addEventListener && navigator.appName.indexOf('Opera')<0){ //FF
		document.addEventListener( "DOMContentLoaded", func, false )
	}else if(navigator.appName.indexOf('Internet Explorer')>=0){ //IE 
		try { // by Diego Perini - http://javascript.nwbox.com/IEContentLoaded/
			document.documentElement.doScroll("left")			
		} catch( error ) {
			window['tmicoxReady'] = setTimeout( function(){ bodyOnReady(func) }, 20 );
			return
		}
		 //chegou aqui sem sair pelo return, executa e limpa timeout
		clearTimeout(window['tmicoxReady'])
		func()
	}else if(navigator.appName.indexOf('Opera')>=0){
		document.addEventListener( "DOMContentLoaded", function () {
			for (var i = 0; i < document.styleSheets.length; i++){
				if (document.styleSheets[i].disabled) {
					window['tmicoxReady'] = setTimeout( function(){ bodyOnReady(func) }, 0 )
					return
				}
			}
			clearTimeout(window['tmicoxReady'])
			func()
		}, false)
	}
}
//chamando
bodyOnReady(ativaMicoxAjax)