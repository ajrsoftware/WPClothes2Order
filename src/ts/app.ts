import hljs from 'highlight.js/lib/core';
import json from 'highlight.js/lib/languages/json';
hljs.registerLanguage('json', json);

document.addEventListener('DOMContentLoaded', () => {
    const element = document.getElementById('wpc2o-example-json');
    if (element) hljs.highlightElement(element);
});
