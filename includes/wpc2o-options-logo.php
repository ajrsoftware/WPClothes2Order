<?php

/**
 * TODO
 * @return string 
 */
function wpc2o_get_logo_view(): string
{
    $content  = '<h1>Logo options</h1>';
    $content .= '<div style="padding: 0 12px">';
    $content .= '<p>Clothes2Order offer six <strong>types</strong> of products, they are:</p>';
    $content .= '<ul style="list-style-type: disc; padding-left: 16px;">';
    $content .= '<li>Bag</li>';
    $content .= '<li>Bottoms</li>';
    $content .= '<li>Hat</li>';
    $content .= '<li>Tea towels</li>';
    $content .= '<li>Tie</li>';
    $content .= '<li>Tops</li>';
    $content .= '</ul>';
    $content .= '<p>For more information, please see the <a href="https://www.clothes2order.com/docs/position-codes" target="_blank" rel="noopener noreferrer">C2O position docs</a>.</p>';
    $content .= '</div>';

    return $content;
}

function wpc2o_logo_artwork_detail_view(): string
{
    $content  = '<h2>Accepted artwork</h2>';
    $content .= '<br />';
    $content .= '<div style="padding: 0 12px">';
    $content .= '<strong>What is the Maximum Size My Logo Can Be?:</strong>';
    $content .= '<p>The maximum width for print is 30cm.</p>';
    $content .= '<p>The maximum width for embroidery is 25cm.</p>';
    $content .= '<p>The height of your logo or image will automatically be scaled based on the width you select.</p>';
    $content .= '<hr />';
    $content .= '<br />';
    $content .= '<strong>What File Types Do You Accept?:</strong>';
    $content .= '<p>The best quality artwork is usually a vectored image file, either an .ai, .eps, or .pdf.</p>';
    $content .= '<p>We accept the following image types: jpg, jpeg, gif, bmp, ai, eps, ps, pdf, png, psd, svg, tiff, tif. The maximum size file you can upload per logo is 50mb.</p>';
    $content .= '<hr />';
    $content .= '<br />';
    $content .= '<strong>What is Digitisation?:</strong>';
    $content .= '<p>Each embroidery logo is digitally recreated so it can be read by our embroidery machines and achieve an expectational level of accuracy to the original design.</p>';
    $content .= '<p>You will always receive artwork proof for new embroidery designs</p>';
    $content .= '</div>';

    return $content;
}

/**
 * TODO
 * @return string 
 */
function wpc2o_get_logo_position_detail_view(): string
{
    $content  = '<h2>Positions and widths explained</h2>';
    $content .= '<div style="padding: 0 12px">';
    $content .= '<p>Depending on what <strong>type</strong> of product you select, depends on what positions of logos are available, for example:</p>';
    $content .= '<p>If you are selling a <i>bag</i>, then you can only place a logo on the <u>front</u> of the bag. <br>';
    $content .= 'However if you are selling a pair of trousers, then you can place the logo either on the <u>left pocket</u>, or the <u>right pocket</u>. There is no <u>front</u>.</p>';
    $content .= 'So when creating a product and you have selected it to be a WPC2O product, you <strong>must</strong> provide the product <u>type</u>, <u>position</u> and <u>width</u>.<br>';
    $content .= 'Widths are shown in centimeters, for example logo position <i>Right sleeve</i> for a <i>Top</i> can have a logo width between <u>1cm - 10cm</u>.</p>';
    $content .= '<h4>Below are all the current logo positions relevant to their product type:</h4>';

    $content .= '<table>';
    $content .= '<thead>';
    $content .= '<tr>';
    $content .= '<th style="padding: 10px 5px; border-bottom: 1px solid black;">Product type</th>';
    $content .= '<th style="padding: 10px 5px; border-bottom: 1px solid black;">Logo position</th>';
    $content .= '<th style="padding: 10px 5px; border-bottom: 1px solid black;">Position code</th>';
    $content .= '<th style="padding: 10px 5px; border-bottom: 1px solid black;">Available widths based on position</th>';
    $content .= '</th>';
    $content .= '</tr>';

    $content .= '<tbody>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px;">Tops</td>';
    $content .= '<td style="padding: 3px 5px;">Right sleeve</td>';
    $content .= '<td style="padding: 3px 5px;">1</td>';
    $content .= '<td style="padding: 3px 5px;">1cm - 10cm</td>';
    $content .= '</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px;">Tops</td>';
    $content .= '<td style="padding: 3px 5px;">Right bottom</td>';
    $content .= '<td style="padding: 3px 5px;">2</td>';
    $content .= '<td style="padding: 3px 5px;">1cm - 12cm</td>';
    $content .= '</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px;">Tops</td>';
    $content .= '<td style="padding: 3px 5px;">Right chest</td>';
    $content .= '<td style="padding: 3px 5px;">3</td>';
    $content .= '<td style="padding: 3px 5px;">1cm - 12cm</td>';
    $content .= '</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px;">Tops</td>';
    $content .= '<td style="padding: 3px 5px;">Center chest</td>';
    $content .= '<td style="padding: 3px 5px;">4</td>';
    $content .= '<td style="padding: 3px 5px;">1cm - 30cm</td>';
    $content .= '</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px;">Tops</td>';
    $content .= '<td style="padding: 3px 5px;">Center back</td>';
    $content .= '<td style="padding: 3px 5px;">8</td>';
    $content .= '<td style="padding: 3px 5px;">1cm - 30cm</td>';
    $content .= '</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px;">Tops</td>';
    $content .= '<td style="padding: 3px 5px;">Left sleeve</td>';
    $content .= '<td style="padding: 3px 5px;">7</td>';
    $content .= '<td style="padding: 3px 5px;">1cm - 10cm</td>';
    $content .= '</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px;">Tops</td>';
    $content .= '<td style="padding: 3px 5px;">Left chest</td>';
    $content .= '<td style="padding: 3px 5px;">5</td>';
    $content .= '<td style="padding: 3px 5px;">1cm - 12cm</td>';
    $content .= '</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px;">Tops</td>';
    $content .= '<td style="padding: 3px 5px;">Left bottom</td>';
    $content .= '<td style="padding: 3px 5px;">6</td>';
    $content .= '<td style="padding: 3px 5px;">1cm - 12cm</td>';
    $content .= '</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px;">Tops</td>';
    $content .= '<td style="padding: 3px 5px;">Top back</td>';
    $content .= '<td style="padding: 3px 5px;">9</td>';
    $content .= '<td style="padding: 3px 5px;">1cm - 30cm</td>';
    $content .= '</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px;">Tops</td>';
    $content .= '<td style="padding: 3px 5px;">Bottom back</td>';
    $content .= '<td style="padding: 3px 5px;">12</td>';
    $content .= '<td style="padding: 3px 5px;">1cm - 30cm</td>';
    $content .= '</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px;">Tops</td>';
    $content .= '<td style="padding: 3px 5px;">Top chest</td>';
    $content .= '<td style="padding: 3px 5px;">17</td>';
    $content .= '<td style="padding: 3px 5px;">1cm - 30cm</td>';
    $content .= '</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">Tops</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">Inside back (labels)</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">18</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">1cm - 12cm</td>';
    $content .= '</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px;">Bottoms</td>';
    $content .= '<td style="padding: 3px 5px;">Left pocket</td>';
    $content .= '<td style="padding: 3px 5px;">15</td>';
    $content .= '<td style="padding: 3px 5px;">1cm - 12cm</td>';
    $content .= '</tr>';
    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">Bottoms</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">Right pocket</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">16</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">1cm - 12cm</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">Bag</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">Front</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">13</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">1cm - 30cm</td>';
    $content .= '</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">Hats</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">Front</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">11</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">1cm - 10cm</td>';
    $content .= '</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">Tea towels</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">Center</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">14</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">1cm - 30cm</td>';
    $content .= '</td>';
    $content .= '</tr>';

    $content .= '<tr>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">Tie</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">Front</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">19</td>';
    $content .= '<td style="padding: 3px 5px; border-bottom: 1px solid black;">1cm - 5cm</td>';
    $content .= '</td>';
    $content .= '</tr>';

    $content .= '</thead>';
    $content .= '</table>';

    $content .= '</div>';
    return $content;
}
