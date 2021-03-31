import EasyMDE from "easymde";

const easyMDE = new EasyMDE({
    element: document.getElementById("article_content"),
    minHeight: "500px",
    showIcons: ['strikethrough', 'code', 'table', 'redo', 'heading', 'undo', 'heading-bigger', 'heading-smaller', 'heading-1', 'heading-2', 'heading-3', 'clean-block', 'horizontal-rule'],
    autosave: {
        enabled: false,
        delay: 1000,
        uniqueId: 'article_content_saved'
    },
    autoDownloadFontAwesome: true,
    lineWrapping: true,
    lineNumbers: true,
    placeholder: "Type here .."
});
