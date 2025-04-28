<script>
	resetToken();
	
	$(window).load(function() {
		resetToken(false);
	});
	
	$(document).ready(function(){
		resetToken(false);
		
		setInterval(function(){
			resetToken();
		}, 115000);
	});
	
	function resetToken(reseta=true){
		if(document.formContato != null || document.formNews != null || document.formTrabalhe != null || document.formEbook != null){
			grecaptcha.ready(function() {
				grecaptcha.execute('6Lfukl0aAAAAAG2gYXiRBAdzgFNZBwmH40968ibN', {action: 'homepage'}).then(function(token) {
					atualizaTokens(token, reseta);
				});
			});
		}
	}
	
	function atualizaTokens(token){
		var formularios = ['formContato', 'formNews', 'formTrabalhe', 'formEbook'];
		var total = formularios.length;
		var idToken, x;
		
		for(var i=0; i<total; i++){
			
			if(document.getElementsByName(formularios[i])[0] != null){
				idToken = "token"+i;
				if(document.getElementById(idToken) == null){
					x = document.createElement("INPUT");
					x.setAttribute("type", "hidden");
					x.setAttribute("id", idToken);
					x.setAttribute("name", "token");
					x.setAttribute("value", "token");
					document.getElementsByName(formularios[i])[0].appendChild(x);
					
					reseta=true;
				}
				
				if(reseta){
					document.getElementById(idToken).value = token;
				}
			}
		}
	}
</script>