import hljs from 'highlight.js/lib/core';
import json from 'highlight.js/lib/languages/json';
hljs.registerLanguage('json', json);

document.querySelectorAll('.wpc2o-expand-details').forEach((element) => {
    element?.addEventListener('click', (event) => {
        event.preventDefault();
        element?.nextElementSibling?.classList.toggle('show');
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const element = document.getElementById('wpc2o-example-json');
    if (element) {
        hljs.highlightElement(element);

        document
            .getElementById('wpc2o-expand-api-request')
            ?.addEventListener('click', (event) => {
                event.preventDefault();
                element.classList.toggle('wpc2o-example-show');
            });

        document
            .getElementById('wpc2o-copy-api-request')
            ?.addEventListener('click', (event) => {
                event.preventDefault();
                navigator.clipboard.writeText(element.innerText);
            });
    }
});
