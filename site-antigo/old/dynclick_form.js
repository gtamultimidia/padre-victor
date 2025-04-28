/*
 * ClickMedia
 * Copyright 2004 ClickMedia - http://www.clickmedia.com.br
 * Patrick Martins Freu
 */
function DFfield(fld,defOblig){var T=this;T.obj=fld;T.t=fld.type;T.n=fld.name;T.tit=fld.getAttribute('title');T.xt=fld.getAttribute('xtype');T.minL=fld.getAttribute('minlength');T.maxL=fld.getAttribute('maxchar');T.equal=fld.getAttribute('equal');T.dIni=fld.getAttribute('DFdateIni');T.dFin=fld.getAttribute('DFdateFin');T.ob=(defOblig==true);if(T.t=='submit'||T.t=='button'||T.t=='image'||T.t=='reset'){T.ob=false;}else{var tAt=fld.getAttribute('obligatory');if(tAt=='true'){T.ob=true;}else if(tAt=='false'){T.ob=false;}}if(T.t=='file'){T.ext=fld.getAttribute('extension');}T.ckFrmAlert=DFckFrmAlert;T.ckEqual=DFckEqual;T.ckMinLen=DFckMinLen;T.ckMaxLen=DFckMaxLen;T.ckFile=DFckFile;T.getDateValues=DFgetDateValues;T.ckNumber=DFckNumber;T.ckChar=DFckChar;T.ckFullname=DFckFullname;T.ckEmail=DFckEmail;T.ckDateDay=DFckDateDay;T.ckDateMonth=DFckDateMonth;T.ckDateYear=DFckDateYear;T.ckDate=DFckDate;T.ckCpf=DFckCpf;T.ckCnpj=DFckCnpj;T.getValues=DFgetValues;T.v=[];T.v=T.getValues()[0];T.len=T.getValues()[1][0];T.lenSel=T.getValues()[1][1];}function DFgetValues(){var T=this;var Tobj=T.obj;var Tf=Tobj.form;var vals=[];vals[0]=[];vals[1]=[];vals[1][0]=1;vals[1][1]=0;if(T.xt=='date'){vals[0]=T.getDateValues();}else{if(T.t=='text'||T.t=='file'||T.t=='textarea'||T.t=='password'){if(Tobj.value!=''){vals[0][0]=Tobj.value;vals[1][1]=Tobj.value.length;}}else if(T.t=='select-one'){vals[1][0]=Tobj.length;if(Tobj[Tobj.selectedIndex].value!=''){vals[0][0]=Tobj[Tobj.selectedIndex].value;vals[1][1]=1;}}else if(T.t=='select-multiple'){vals[1][0]=Tobj.length;for(var sm=0;sm<vals[1][0];sm++){if(Tobj[sm].selected){vals[0][T.v.length]=Tobj[sm].value;vals[1][1]++;}}}else if(T.t=='checkbox'){if(Tf[T.n].length!=null){vals[1][0]=Tf[T.n].length;for(var j=0;j<vals[1][0];j++){if(Tf[T.n][j].checked){vals[0][T.v.length]=Tf[T.n][j].value;vals[1][1]++;}}}else{if(Tobj.checked)vals[0][0]=Tobj.value;vals[1][1]=1;}}else if(T.t=='radio'){if(Tf[T.n].length!=null){vals[1][0]=Tf[T.n].length;for(var j=0;j<vals[1][0];j++){if(Tf[T.n][j].checked)vals[0][0]=Tf[T.n][j].value;vals[1][1]++;}}else{if(Tf[T.n].checked)vals[0][0]=Tf[T.n].value;vals[1][1]=1;}}}return vals;}function DFgetDateValues(){var T=this;var Tobj=T.obj;var Tf=Tobj.form;var fName=T.n.substr(0,T.n.lastIndexOf('_')+1);var d=(T.t=='text')?eval('Tf.'+fName+'dia').value:DFgetValSel(eval('Tf.'+fName+'dia'));var m=(T.t=='text')?eval('Tf.'+fName+'mes').value:DFgetValSel(eval('Tf.'+fName+'mes'));var a=(T.t=='text')?eval('Tf.'+fName+'ano').value:DFgetValSel(eval('Tf.'+fName+'ano'));return Array(d,m,a);}function DFgetDateObject(d,m,a){if(d==''||m==''||a=='')return null;m--;if(!DFckDateDay(d))return false;else if(!DFckDateMonth(m))return false;else if(!DFckDateYear(a))return false;else if((m==3||m==5||m==8||m==10)&&(d==31))return false;else if(m==1&&(d>29||(d==29&&((a%4)!=0))))return false;return new Date(a,m,d);}function DFgetValSel(c,ind){var i=c.selectedIndex;return(ind)?i:c[i].value;}var DFsbm=false;function DFckForm(f,defOblig){DFclrClass(f);for(var i=0;i<f.length;i++){if(f[i].type==null)i++;var T=new DFfield(f[i],defOblig);if(T.xt=='date'){var ret=T.ckDate();if(T.ob&&!ret){if(!ret)return T.ckFrmAlert(((ret==null)?1:null));}else{if(T.v[0]!=''||T.v[1]!=''||T.v[2]!=''){if(!ret)return T.ckFrmAlert();}}i=i+2;}else{if((T.t=='radio')||(T.t=='checkbox')){i=i+(T.len-1);}if(T.v.length==0){if(T.t!='hidden'&&(T.ob)){if(T.t=='select-one'||T.t=='select-multiple'||T.t=='checkbox'||T.t=='radio'){return T.ckFrmAlert(0);}else if(T.t=='file'||T.t=='text'||T.t=='textarea'||T.t=='password'){return T.ckFrmAlert(1);}}else if((T.t=='select-multiple'||T.t=='checkbox')&&T.minL){if(!T.ckMinLen((T.t=='select-multiple'||T.t=='checkbox')?1:0))return false;}}else{if(T.t=='text'||T.t=='textarea'||T.t=='password'||T.t=='select-multiple'||T.t=='checkbox'){if(T.minL){if(!T.ckMinLen((T.t=='select-multiple'||T.t=='checkbox')?1:0))return false;}if(T.maxL&&(T.t!='text'||T.t!='password')){if(!T.ckMaxLen())return false;}if(T.xt){S='T.ck'+T.xt.charAt(0).toUpperCase()+T.xt.substring(1).toLowerCase()+'()';if(!eval(S)){return T.ckFrmAlert();}}if(T.equal){if(!T.ckEqual(f[T.equal]))return false;}}else if(T.t=='file'&&T.v.length!=0&&T.ext){if(!T.ckFile(T.ext))return T.ckFrmAlert(8);}}}}if(!DFsbm){DFsbm=true;return true;}else{return false;}}function DFckFrmAlert(m){var T=this;var scrTop=DFscrollTopPosition();if(T.t!='hidden'){var Tf=T.obj.form;if((T.t=='radio'||T.t=='checkbox')&&T.len>1){for(var i=0;i<T.len;i++){Tf[T.n][i].className='DF-alert';}}else if(T.xt=='date'){var fName=T.n.substr(0,T.n.lastIndexOf('_')+1);eval('Tf.'+fName+'dia').className='DF-alert';eval('Tf.'+fName+'mes').className='DF-alert';eval('Tf.'+fName+'ano').className='DF-alert';}else T.obj.className='DF-alert';if(T.equal)Tf[T.equal].className='DF-alert';T.obj.focus();}if(scrTop!=DFscrollTopPosition())scrollBy(null,scrTop>DFscrollTopPosition()?-20:80);if(null!=m){if(m==7){var maxL=T.maxL;}else if(m==5){var minL=T.minL;}else if(m==8){var ext=T.ext;}S=eval(DFMsg[m]);}else{if(T.xt)S=eval(DFMsg[2]);}alert(S);return false;}function DFalert(a,cArr){var c1=((cArr[0].length>0)?cArr[0][0]:cArr[0]);DFclrClass(c1.form);for(var i=0;i<cArr.length;i++){var T=cArr[i];if(T.length>0){if(T[0].type=='radio'||T[0].type=='checkbox'){for(var j=0;j<T.length;j++){T[0].form[T[0].name][j].className='DF-alert';}}else{T.className='DF-alert';}}else{T.className='DF-alert';}}c1.focus();alert(a);DFsbm=false;return false;}function DFclrClass(f){for(var i=0;i<f.length;i++){if(!f[i].classNameOld){f[i].classNameOld=f[i].className||'DF-null';}else{f[i].className=f[i].classNameOld;}}}function DFscrollTopPosition(){return(is.ie)?document.body.scrollTop:pageYOffset;}function DFckEqual(cF){if(this.v[0]!=cF.value)return this.ckFrmAlert(3);else return true;}function DFckMinLen(ar){var T=this;if(T.minL&&(T.lenSel<T.minL)){return T.ckFrmAlert((ar)?5:4);}return true;}function DFckMaxLen(){var T=this;if(T.maxL&&(T.lenSel>T.maxL)){if(T.t=='textarea'){if(typeof(T.obj.form.DFcounter)!='undefined'&&typeof(T.obj.form.DFcounter)!='unknown'){DFtextareaCounter(T.obj);}}return T.ckFrmAlert((T.t!='textarea')?7:6);}return true;}function DFckFile(ext){var e=ext.split(",");var v=this.v[0].toLowerCase();for(var i=0;i<e.length;i++){if(v.substr(v.lastIndexOf('.')+1)==e[i])return true;}return false;}function DFckNumber(){return(this.v[0].match(/^[0-9]+$/));}function DFckChar(){return(this.v[0].match(/^[a-záàãâäéèêëíìîïóòõôöúùûüç.´\s]+$/i));}function DFckFullname(){return(this.v[0].match(/[^\s]+\s.+/));}function DFckEmail(){var Tv=this.v[0].toLowerCase();return(Tv.match(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]{2,64}(\.[a-z0-9-]{2,64})*\.[a-z]{2,3}$/));}function DFckDateDay(v){if(v>0&&v<32)return true;}function DFckDateMonth(v){if(v>=0&&v<12)return true;}function DFckDateYear(v){if(v>0&&v.length==4)return true;}function DFckDate(){var T=this;var Tdate=DFgetDateObject(T.v[0],T.v[1],T.v[2]);if(!Tdate)return Tdate;if(T.dIni||T.dFin){var dI=T.dIni.split('/');var dF=T.dFin.split('/');var dI=(T.dIni)?DFgetDateObject(dI[0],dI[1],dI[2]):new Date(1900,00,01);var dF=(T.dFin)?DFgetDateObject(dF[0],dF[1],dF[2]):new Date();if(Tdate<dI||Tdate>dF)return false;}return true;}function DFckCpf(){var s=null;var r=null;var v=this.v[0];if(v.length!=11||v.match(/1{11}|2{11}|3{11}|4{11}|5{11}|6{11}|7{11}|8{11}|9{11}|0{11}/))return false;s=0;for(var i=0;i<9;i++)s+=parseInt(v.charAt(i))*(10-i);r=11-(s%11);if(r==10||r==11)r=0;if(r!=parseInt(v.charAt(9)))return false;s=0;for(var i=0;i<10;i++)s+=parseInt(v.charAt(i))*(11-i);r=11-(s%11);if(r==10||r==11)r=0;if(r!=parseInt(v.charAt(10)))return false;return true;}function DFckCnpj(){var v=this.v[0];var m=['543298765432','6543298765432'];var d=[0,0];for(var t=0;t<2;t++){for(x=0;x<13;x++){if((t==0&&x!=12)||t==1)d[t]+=(parseInt(v.slice(x,x+1))*parseInt(m[t].slice(x,x+1)));}d[t]=(d[t]*10)%11;if(d[t]==10)d[t]=0;}return(d[0]==parseInt(v.slice(12,13))&&d[1]==parseInt(v.slice(13,14)));}function DFtextareaMaxLen(f,l,e){if(is.ns){if(e.which==0||e.which==8)return true}if(f.value.length>=l)return false;}function DFtextareaCounter(f){f.form.DFcounter.value=f.value.length;}function DFonlyThisChars(n,l,o,e){if(window.event)key=window.event.keyCode;else if(e)key=e.which;else return true;S=(o)?o:'';if(n)S+='0123456789';if(l)S+='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';if(key==null||key==0||key==8||key==9||key==13||key==27)return true;else if(S.indexOf(String.fromCharCode(key))!=-1)return true;else return false;}function DFnotOnlyThisChars(S,e){if(window.event)key=window.event.keyCode;else if(e)key=e.which;else return true;if(!S)return false;else if(key==null||key==0||key==8||key==9||key==13||key==27)return true;else if(S.indexOf(String.fromCharCode(key))!=-1)return false;else return true;}function DFchangeField(o,e,d){if(window.event)key=window.event.keyCode;else if(e)key=e.which;else return true;if(key==9||key==2||key==16)return false;if(d<=2&&o.value.length==o.maxLength){for(var i=0;i<o.form.length;i++){if(o.form[i]==o&&o.form[i+1]){o.form[i+1].focus();break;}}}if(d>1&&o.value.length==0&&key==8){for(var i=0;i<o.form.length;i++){if(o.form[i]==o&&o.form[i-1]){o.form[i-1].focus();o.form[i-1].value=o.form[i-1].value;break;}}}}
function Apaga(){if(confirm("Tem certeza de que deseja apagar o item selecionado?")){return true;}else{return false;}}

function Mask_Moeda(obj,num){
				var tecla = '';
				var i = j = 0;
				var len = len2 = 0;
				var strCheck = '0123456789';
				var aux = aux2 = '';
				if (event.keyCode == 0 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 13 || event.keyCode == 27)
					return true;
				if (event.shiftKey)
					return true;
				tecla = String.fromCharCode(event.keyCode);
				if (strCheck.indexOf(tecla) == -1) 
					return false;
				len = obj.value.length;
				if (len == num)  // tamanho máximo do valor incluindo as vírgulas
					return false;
				for(i = 0; i < len; i++){
					if ((obj.value.charAt(i) != '0') && (obj.value.charAt(i) != ',')) 
						break;
				}
				aux = '';
				for(; i < len; i++){
					if (strCheck.indexOf(obj.value.charAt(i))!=-1) 
						aux += obj.value.charAt(i);
				}
				aux += tecla;
				len = aux.length;
				if (len == 0) 
					obj.value = '';
				if (len == 1) 
					obj.value = '0,0' + aux;
				if (len == 2) 
					obj.value = '0,' + aux;
				if (len > 2) {
					aux2 = '';
					for (j = 0, i = len - 3; i >= 0; i--) {
						if (j == 3) {
							aux2 += '.';
							j = 0;
						}
						aux2 += aux.charAt(i);
						j++;
					}
					obj.value = '';
					len2 = aux2.length;
					for (i = len2 - 1; i >= 0; i--)
						obj.value += aux2.charAt(i);
					obj.value += ',' + aux.substr(len - 2, len);				
				}
				return false;
			}
			
function Mask_Peso(obj,num){
				var tecla = '';
				var i = j = 0;
				var len = len2 = 0;
				var strCheck = '0123456789';
				var aux = aux2 = '';
				if (event.keyCode == 0 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 13 || event.keyCode == 27)
					return true;
				if (event.shiftKey)
					return true;
				tecla = String.fromCharCode(event.keyCode);
				if (strCheck.indexOf(tecla) == -1) 
					return false;
				len = obj.value.length;
				if (len == num)  // tamanho máximo do valor incluindo as vírgulas
					return false;
				for(i = 0; i < len; i++){
					if ((obj.value.charAt(i) != '0') && (obj.value.charAt(i) != ',')) 
						break;
				}
				aux = '';
				for(; i < len; i++){
					if (strCheck.indexOf(obj.value.charAt(i))!=-1) 
						aux += obj.value.charAt(i);
				}
				aux += tecla;
				len = aux.length;
				if (len == 0) 
					obj.value = '';
				if (len == 1) 
					obj.value = '0,00000' + aux;
				if (len == 2) 
					obj.value = '0,0000' + aux;
				if (len == 3) 
					obj.value = '0,000' + aux;
				if (len == 4) 
					obj.value = '0,00' + aux;
				if (len == 5) 
					obj.value = '0,0' + aux;
				if (len == 6) 
					obj.value = '0,' + aux;
				if (len > 6) {
					aux2 = '';
					for (j = 0, i = len - 7; i >= 0; i--) {
						if (j == 3) {
							aux2 += '.';
							j = 0;
						}
						aux2 += aux.charAt(i);
						j++;
					}
					obj.value = '';
					len2 = aux2.length;
					for (i = len2 - 1; i >= 0; i--)
						obj.value += aux2.charAt(i);
					obj.value += ',' + aux.substr(len - 6, len);				
				}
				return false;
			}

function formataValorMonetario(campooriginal,decimais)
{
  var posicaoPontoDecimal;
  var campo = '';
  var resultado = '';
  var pos,sep,dec;

//Retira possiveis separadores de milhar
  for (pos=0; pos < campooriginal.value.length; pos ++)
  {
    if (campooriginal.value.charAt(pos)!='.')
        campo = campo + campooriginal.value.charAt(pos);
  }     

//Formata valor monetário com decimais
  posicaoPontoDecimal = campo.indexOf(',');
  if (posicaoPontoDecimal != -1)
   {
      sep = 0;
      for (pos=posicaoPontoDecimal-1;pos >= 0;pos--)
      {
        sep ++;
        if (sep > 3)
        {
           resultado = '.' + resultado;
           sep = 1;
        }

        resultado = campo.charAt(pos) + resultado;   
      }

      // Trata parte decimal
      if (parseInt(decimais) > 0 )
      {
         resultado = resultado + ',';
      
         pos=posicaoPontoDecimal+1;
         for (dec = 1;dec <= parseInt(decimais); dec++)
         {
           if (pos < campo.length)
           {
              resultado = resultado + campo.charAt(pos);
              pos++;
           }
           else
              resultado = resultado + '0';   
         }

      } // trata decimais
   }
   // Trata valor monetário sem decimais
   else
   {
      sep = 0;
      for (pos=campo.length-1;pos >= 0;pos--)
      {
        sep ++;
        if (sep > 3)
        {
           resultado = '.' + resultado;
           sep = 1;
        }
        resultado = campo.charAt(pos) + resultado;   
      }
      // Trata parte decimal
      if (parseInt(decimais) > 0 )
      {
         resultado = resultado + ',';
         for (dec = 1;dec <= parseInt(decimais); dec++)
         {
              resultado = resultado + '0';   
         }
      } // trata decimais
   }
   campooriginal.value = resultado;

	var reDecimalPt = /^[+-]?((\d+|\d{1,3}(\.\d{3})+)(\,\d*)?|\,\d+)$/;
	var reDecimalEn = /^[+-]?((\d+|\d{1,3}(\,\d{3})+)(\.\d*)?|\.\d+)$/;
	var reDecimal = reDecimalPt;
	var pLang = "Pt"
	
		charDec = ( pLang != "Pt"? ",": "." );
		eval("reDecimal = reDecimal" + pLang);
		if (reDecimal.test(resultado)) {
			pos = resultado.indexOf(charDec);
			decs = pos == -1? 0: resultado.length - pos - 1;
		} else if (resultado != null && resultado != "") {
			alert(resultado + " NÃO é um número válido.");
			campooriginal.focus();
		}
	} 

function numero_menor(obj,num){
				if (parseInt(obj.value) > parseInt(num)) { // tamanho máximo do valor
					alert ('A quantidade não deve ultrapassar o limite permitido.');
					obj.value = '0';
				}
				if (obj.value == '') obj.value = '0';
			}
			
function len_menor(obj,num){
				if (parseInt(obj.value.length) > parseInt(num)) { // tamanho máximo em caracteres do valor
					alert ('A quantidade não deve ultrapassar o limite de ' + num + ' caracteres permitidos.');
					obj.value = obj.value.substr(obj.value, num)
				}
			}