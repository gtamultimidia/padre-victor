<link href="css/politica.css" rel="stylesheet" type="text/css"/>

<a href="politica-de-privacidade" class="btnPoliticaPrivacidade">Política de Privacidade</a>
<div class="box-cookies hide">
    <div class="max-cookie">
        <p class="msg-cookies">Esse site usa cookies para melhorar sua experiência. Ao navegar você concorda com os termos e políticas do site.</p>
        <div class="opecacao-cookie">
            <button class="btn-cookies">Ok! Fechar.</button>
            <a href="politica-de-privacidade" class="btn-saiba-mais">Saiba mais</a>
        </div>
    </div>
</div>

<script>
    (() => {
        if (!localStorage.pureJavaScriptCookies) {
          document.querySelector(".box-cookies").classList.remove('hide');
          document.querySelector(".btnPoliticaPrivacidade").classList.add('hide');
        }

        const acceptCookies = () => {
          document.querySelector(".box-cookies").classList.add('hide');
          document.querySelector(".btnPoliticaPrivacidade").classList.remove('hide');
          localStorage.setItem("pureJavaScriptCookies", "accept");
        };

        const btnCookies = document.querySelector(".btn-cookies");

        btnCookies.addEventListener('click', acceptCookies);
    })();
</script>