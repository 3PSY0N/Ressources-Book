import hljs from "highlight.js";

hljs.registerLanguage("css", require("highlight.js/lib/languages/css"));
hljs.registerLanguage("javascript",require("highlight.js/lib/languages/javascript"));
hljs.registerLanguage("php",require("highlight.js/lib/languages/php"));
hljs.registerLanguage("xml",require("highlight.js/lib/languages/xml"));
hljs.highlightAll();
