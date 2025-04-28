$(document).ready(function(){
    tinymce.init({
        selector: "#texto",
        plugins: ["smileys", "image", "jbimages", "textcolor", "media", "advlist" , "autolink", "autosave", "link", "image", "lists", "charmap", "print", "preview", "hr", "anchor", "pagebreak", "searchreplace", "wordcount", "visualblocks", "visualchars", "code", "fullscreen", "insertdatetime", "media", "nonbreaking", "table", "contextmenu", "directionality", "emoticons", "textcolor", "paste", "textcolor", "colorpicker", "textpattern"],
        menubar: ["insert", "tools"],
        toolbar1: "newdocument fullpage | print fullscreen | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | searchreplace | removeformat | undo redo | styleselect formatselect fontselect fontsizeselect | forecolor backcolor",
        toolbar2: "cut copy paste | bullist numlist | outdent indent blockquote | link unlink anchor image  jbimages media code",
        toolbar3: "table | hr | subscript superscript | charmap emoticons | insertdatetime preview",
        fontsize_formats: '6pt 7pt 8pt 9pt 10pt 11pt 12pt 14pt 18pt 24pt 36pt',
        toolbar_items_size: 'small',
        browser_spellcheck : true,
        force_br_newlines: false,
        force_p_newlines: false,
        forced_root_block: '',
        image_class_list: [
            {title: 'Responsive', value: 'img-responsive'}
        ]
    });
});