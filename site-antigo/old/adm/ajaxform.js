var isIE = /*@cc_on!@*/false; //vendo se é o IE

function ajaxGo(param){
/**
* ajaxGo - envia uma solicitação ajax simples ou submete um formulário via ajax
* sintaxe: ajaxGo({})
* Versão: 1.0 - 28/12/2007
* Autor: Micox - www.elmicox.com - elmicox.blogspot.com
* Licença: Creative Commons - http://creativecommons.org/licenses/by/2.5/br/
* Some Rights Reserved - http://creativecommons.org/licenses/by/2.5/
**/

    /******** declaracao de variaveis ********/    
    var url, the_form, callback, timeout, elem_return, unescape_, hide_err; //vars que receberão os parametros da funcao
    var concat, url_orig, msg, timeload, timeout, ajax; //outras variáveis
    var method='GET', query='', loadpos=0, timecounter=0, self=this; //variáveis inicializadas
    var loads = ['&nbsp;&nbsp;&nbsp;','.&nbsp;&nbsp;','..&nbsp;','...']; //animacao do loading

    
    /******** pegando os parametros obrigatorios ********/    
    if(!param.url && !param.form){//pelo menos 1 dos 2 argumentos deve ser obrigatório
        alert('Programador, reveja sua chamada ao ajaxGo.\r\nVocê deve informar pelo menos a "url" ou o "form".');
        return false;
    }
    if(param.url){ url = param.url; }
    if(param.form){
        if(typeof(param.form)=='string'){ //id do form passada
            the_form = document.getElementById(param.form);
            
        }else if(typeof(param.form.nodeType)!='undefined'){ //form passado como referencia ao objeto html
            the_form = param.form;
        }
        
        if(the_form && the_form.nodeName.toLowerCase()=='form'){//se o elemento existe e é realmente um form
            if(!url) { url = the_form.action; }
            method = the_form.method.toUpperCase();
            
        }else{ //form não existe
            alert('Programador, reveja sua chamada ao ajaxGo.\r\nO form "' + url_ou_form + '" informado, nao existe');
            return false;
        }
        
    }
    //pegando os parametros opcionais.
    if(param.callback){ callback = param.callback; }
    if(param.timeout){ timeout = param.timeout; }
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
    
    /******** começando o ajax ********/    
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
    
        if(method=='GET'){
            query = query.substr(0,2030); //IE limits http://classicasp.aspfaq.com/forms/what-is-the-limit-on-querystring/get/url-parameters.html
            ajax.open(method, url + concat + query ,true);
            ajax.setRequestHeader("Content-Type", "text/html; charset=utf-8");
            ajax.setRequestHeader("Content-length", query.length);
            query=''; 
            
        }else{ //POST
            ajax.open(method, url ,true);
            ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
            ajax.setRequestHeader("Content-length", query.length);            
        }
        ajax.setRequestHeader('X-Requested-With', 'ajax'); //dizendo ao servidor que foi pedido via ajax. Recupera-se com $_SERVER['X-Requested-With'] (no php)
        ajax.setRequestHeader("Cache-Control", "no-cache");
        ajax.setRequestHeader("Pragma", "no-cache");
        ajax.send(query);
        
        //função periódica que verifica o timeout e gera animação
        timeload = setInterval(periodic,250); 
        
        return true;
        
    }else{
        return false;
    }


    /******** funções extra que serão chamadas    ****************/
    
    function ajaxOnReady(){ //executada a cada alteração no status http
    
        if(timecounter/4 > timeout){ //estourou o timeout. O abort() foi feito na funcao periodic()                
            clearInterval(timeload); //fim do contador
            msg = "Falha no carregamento. Tempo limite excedido: " + timeout + ' segs.';
            if(!hide_err){ put(msg); }
            window.status = '';
                        
            if(callback){ callback(msg); } //chamando a função de callback

            ajax = null; delete ajax;
            delete self;
            return false;
            
        }else if(ajax.readyState==4){ //carregamento (ou não carregamento) completo        
            clearInterval(timeload); //fim do contador
                    
            if(ajax.status == 200){ //com sucesso
                var texto=ajax.responseText;
                if(texto.indexOf(" ")<0) texto=texto.replace(/\+/g, " ");
                if(unescape_==true){ //se tiver usado o urlencode no php ou asp
                    texto=unescape(texto); 
                }
                put(texto);
                getScripts(texto);
                window.status = '';
                if(callback){ callback(texto); } //chamando a função de callback
                
            }else{ //com erro
                msg = "Falha no carregamento. " + httpStatus(ajax.status);
                if(!hide_err){
                }
                if(callback){ callback(msg); } //chamando a função de callback
            }
        
            ajax = null; delete ajax;
            delete self;
            return true;
            
        }else{//para mudar o status de cada carregando
            put('')
            window.status = '';
        }
    }
    function loadsAnim(){ //faz a animaçãozinha no array loads
        if(loading.indexOf('<img')<0){ // 3 dots just if no image
            if(loadpos>loads.length - 1){ loadpos = 0; }
            return loads[loadpos++] + ' ';
        }else{ return '';}        
    }
    function put(valor){ //coloca o valor no elemento de retorno, se houver este
        if(elem_return){
            if(elem_return.nodeName.toLowerCase()=="input"){
                valor = escape(valor).replace(/\%0D\%0A/g, "");
                elem_return.value = unescape(valor);
            }else if(elem_return.nodeName.toLowerCase()=="select"){        
                select_innerHTML(elem_return, valor.replace(/&nbsp;/gi,' ').replace(/&gt;/gi,'>').replace(/&lt;/,'<'));
            }else if(elem_return.nodeName){
                elem_return.innerHTML = valor;
            }  
        }
    }
    function periodic(){ //função executada periodicmente pra fazer animação e testar timeout
        //mensagem indicando o carregamento
        
        //fazendo o contador
        timecounter++; //contador que incrementa-se a cada 1/4 de segundo
        if(timecounter/4 > timeout){ //estourou o timeout
            clearInterval(timeload); //fim do contador
            ajax.abort(); //também dispara a ajaxOnReady
        }

    }
    function getAjax(){ //instancia um novo xmlhttprequest    
        //baseado na getXMLHttpObj que possui muitas cópias na net e eu nao sei quem é o autor original
        if(typeof(XMLHttpRequest)!='undefined'){return new XMLHttpRequest();}
        var axO=['Microsoft.XMLHTTP', 'Msxml2.XMLHTTP','Msxml2.XMLHTTP.6.0','Msxml2.XMLHTTP.4.0','Msxml2.XMLHTTP.3.0'];
        for(var i=0;i<axO.length;i++){ try{ return new ActiveXObject(axO[i]);}catch(e){} }
        return null;
    }
    function httpStatus(stat){ //retorna o texto do erro http
        switch(stat){
            case 0: return "Erro desconhecido de javascript. " + ajax.statusText;
            case 400: return "400: Solicitacao incompreensivel"; 
            case 403: case 404: return "404: Nao foi encontrada a URL solicitada";
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
* Versão: 2.1 - 04/09/2007
*******/
    var opt, selTemp = document.createElement("micoxselect");    
    objeto.innerHTML = ""; selTemp.id="micoxselect1";
    document.body.appendChild(selTemp);
    selTemp = document.getElementById("micoxselect1");
    selTemp.style.display="none";
    
    if(innerHTML.toLowerCase().indexOf("<option")<0){//se não é option eu converto
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
//Author: SkyWalker.TO do imasters/forum (pequenas alterações by Micox)
    var ini = 0;
    // loop enquanto achar um script
    while (ini!=-1){
        // procura uma tag de script
        ini = texto.indexOf('<script', ini);
        if (ini >=0){
            ini = texto.indexOf('>', ini) + 1;
            // procura o final do script
            var fim = texto.indexOf("<\/script>", ini);
            codigo = texto.substring(ini,fim);
            // executa o script - alterado by Micox.
            var novo = document.createElement("script")
            novo.text = codigo;
            document.body.appendChild(novo);
        }
    }
}

function getFieldsForm(fform){ //pega campos do formulário e retorna a querystring correspondente
/**************************************************
* Autor: José Cláudio Medeiros de Lima (pequenas alterações by Micox - 28/12/07)
* url: http://forum.ievolutionweb.com/index.php?showtopic=18264
* Versão: 1.5 - 28/12/2007 - Creative Commons
**************************************************/
    var buff = [];
    for (var i=0; i< fform.length;i++)  {
        var campo = fform.elements[i];
        
        if((campo.type=="checkbox" || campo.type=="radio")){
            if(campo.checked==true && campo.name){ 
                buff.push(campo.name + "=" + encodeURI(campo.value));
            }
        }else if(campo.name){ //campos que não tenham name não vão.
            buff.push(campo.name + "=" + encodeURI(campo.value));
        }
    }
    return buff.join("&");
}