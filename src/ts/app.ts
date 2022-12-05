import hljs from 'highlight.js/lib/core';
import json from 'highlight.js/lib/languages/json';
import { sync } from './stock-sync';

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

        document
            .getElementById('wpc2o-manual-stock-sync-trigger')
            ?.addEventListener('submit', async (event) => {
                event.preventDefault();

                const button = document.getElementById(
                    'wpc2o-manual-stock-sync-trigger-button'
                ) as HTMLButtonElement | null;

                if (button) {
                    button.disabled = true;
                }

                const messageEl = document.createElement('span');
                messageEl.id = 'wpc2o-manual-stock-sync-message';
                messageEl.style.display = 'block';
                messageEl.style.marginBottom = '16px';
                messageEl.innerText =
                    'Sync in progress... please do NOT close this page.';
                messageEl.style.color = '#3858e9';
                messageEl.style.fontWeight = '500';

                button?.after(messageEl);

                const messageNode = document.getElementById(
                    'wpc2o-manual-stock-sync-message'
                );

                const response = await sync();

                if (messageNode && response) {
                    const color = response.status ? 'green' : 'red';
                    messageEl.style.color = color;
                    messageNode.innerText = response.message;
                }

                if (button) button.disabled = false;
            });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    document
        .querySelectorAll('.wpc2o-view-payload-modal-content')
        .forEach((element) => hljs.highlightElement(element as HTMLElement));

    document
        .querySelectorAll('.wpc2o-view-order-payload')
        .forEach((element) => {
            element?.addEventListener('click', (event) => {
                event.preventDefault();
                const modal = element.nextElementSibling;
                if (modal) modal.classList.toggle('open');
            });
        });

    document
        .querySelectorAll('.wpc2o-view-payload-modal-close')
        .forEach((element) => {
            element.addEventListener('click', (event) => {
                event.preventDefault();
                document
                    .querySelectorAll('.wpc2o-view-payload-modal.open')
                    .forEach((modal) => modal.classList.toggle('open'));
            });
        });

    document
        .querySelectorAll('.wpc2o-view-payload-modal-copy')
        .forEach((element) => {
            element.addEventListener('click', (event) => {
                event.preventDefault();
                const currentModal = document.querySelector(
                    '.wpc2o-view-payload-modal.open .wpc2o-view-payload-modal-content'
                ) as HTMLElement;

                if (currentModal)
                    navigator.clipboard.writeText(currentModal.innerText);
            });
        });
});
