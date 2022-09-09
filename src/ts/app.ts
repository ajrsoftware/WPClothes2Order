import hljs from 'highlight.js/lib/core';
import json from 'highlight.js/lib/languages/json';
hljs.registerLanguage('json', json);

document.addEventListener('DOMContentLoaded', () => {
    const element = document.getElementById('wpc2o-example-json');
    if (element) hljs.highlightElement(element);
});

document
    .getElementById('wpc2o-add-logo')
    ?.addEventListener('click', (event) => {
        event.preventDefault();

        console.log({ event, msg: 'yo' });
    });

const countTypesCreated = (): number => {
    return document.querySelectorAll(
        'div.options_group p._type_wp_clothes_two_order_field'
    ).length;
};

const createTypeSelect = (): Element => {
    const count = countTypesCreated();

    const child = document.createElement('div');
    child.className = 'options_group';

    const p = document.createElement('p');
    p.className = 'form-field _type_wp_clothes_two_order_field';

    const label = document.createElement('label');
    label.htmlFor = `_type_wp_clothes_two_order_${count}`;

    const span = document.createElement('span');
    span.className = 'woocommerce-help-tip';

    // <p class=" form-field _type_wp_clothes_two_order_field">
    //     <label for="_type_wp_clothes_two_order">Select product type</label>
    //     <span class="woocommerce-help-tip"></span>{' '}
    //     <select
    //         required="required"
    //         style=""
    //         id="_type_wp_clothes_two_order"
    //         name="_type_wp_clothes_two_order"
    //         class="select short"
    //     >
    //         <option value="top">Top</option>
    //         <option value="bottoms" selected="selected">
    //             Bottoms
    //         </option>
    //         <option value="bag">Bag</option>
    //         <option value="hat">Hat</option>
    //         <option value="tea-towel">Tea towel</option>
    //         <option value="tie">Tie</option>{' '}
    //     </select>
    // </p>;

    return child;
};

const createAddLogoButton = () => {
    const parent = document.querySelector(
        '#wp_clothes_two_order_options #wpc2o-button-parent'
    );

    const addButton = document.createElement('button');
    addButton.id = 'wpc2o-add-logo';
    addButton.innerText = 'Add logo';
    addButton.className = 'button';

    parent?.appendChild(addButton);
};

document.addEventListener('DOMContentLoaded', () => {
    if (
        document
            .getElementById('_enable_wp_clothes_two_order')
            ?.hasAttribute('checked')
    ) {
        createAddLogoButton();
    }
});

document
    .getElementById('_enable_wp_clothes_two_order')
    ?.addEventListener('click', (event) => {
        if ((event?.target as HTMLInputElement).checked) {
            createAddLogoButton();
        } else {
            document.getElementById('wpc2o-add-logo')?.remove();
            const createdNodeList = document.querySelectorAll(
                '#wp_clothes_two_order_options .options_group'
            );

            if (createdNodeList) {
                const created = [...createdNodeList];
                created.shift();
                created.forEach((element) => element.remove());
            }
        }
    });
