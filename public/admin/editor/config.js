var editor_config = {
    path_absolute: "/",
    language: document.documentElement.lang,
    selector: "textarea.my-editor",

    menubar: false,
    statusbar: false,
    toolbar: false,

    relative_urls: false,
    // remove_script_host : false,
    // document_base_url : window.location.href,
    plugins:
        "print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable",
    mobile: {
        plugins:
            "print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker textpattern noneditable help formatpainter pageembed charmap mentions quickbars linkchecker emoticons advtable",
    },
    menu: {
        tc: {
            title: "TinyComments",
            items: "addcomment showcomments deleteallconversations",
        },
    },
    menubar: "file edit view insert format tools table tc help",

    toolbar1:
        "undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons",
    toolbar2:
        "fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment",
    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_prefix: "{path}{query}-{id}-",
    autosave_restore_when_empty: false,
    autosave_retention: "2m",
    image_advtab: true,
    importcss_append: true,
    template_cdate_format: "[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]",
    template_mdate_format: "[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]",
    height: 400,
    image_caption: true,
    quickbars_selection_toolbar:
        "bold italic | quicklink h2 h3 blockquote quicktable",
    noneditable_noneditable_class: "mceNonEditable",
    toolbar_mode: "sliding",
    spellchecker_whitelist: ["Ephox", "Moxiecode"],
    tinycomments_mode: "embedded",
    content_style: ".mymention{ color: gray; }",
    contextmenu: false,
    a11y_advanced_options: true,

    file_picker_callback: function (callback, value, meta) {
        var x =
            window.innerWidth ||
            document.documentElement.clientWidth ||
            document.getElementsByTagName("body")[0].clientWidth;
        var y =
            window.innerHeight ||
            document.documentElement.clientHeight ||
            document.getElementsByTagName("body")[0].clientHeight;

        var cmsURL =
            editor_config.path_absolute +
            "filemanager?editor=" +
            meta.fieldname +
            "&type=files";

        tinyMCE.activeEditor.windowManager.openUrl({
            url: cmsURL,
            title: "مدير الملفات",
            width: x * 0.8,
            height: y * 0.8,
            resizable: "yes",
            close_previous: "no",
            onMessage: (api, message) => {
                callback(message.content);
            },
        });
    },
    init_instance_callback: function (editor) {
        if (document.querySelector(".tox-notifications-container")) {
            document.querySelector(
                ".tox-notifications-container"
            ).style.display = "none";
            console.log("test");
        }
    },
};

tinymce.init(editor_config);
