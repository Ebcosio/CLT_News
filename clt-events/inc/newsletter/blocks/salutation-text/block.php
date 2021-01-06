<?php
/*
 * Name: Salutation for Dept. Chairs
 * Section: content
 * Description: text with signature image
 *
 */

/* @var $options array */
/* @var $wpdb wpdb */

$default_options = array(
    'html'=>'',
    'block_padding_left' => 15,
    'block_padding_right' => 15,
    'block_padding_top' => 20,
    'block_padding_bottom' => 10,
    'block_background' => '#ffffff',
    'font_family' => 'Helvetica, Arial, sans-serif',
    'font_size' => 16,
    'font_color' => '#000'
);

$default_options['html'] = '
<h3>Department Chairs:</h3>
<p style="font-size: 16px">Please share this timely news with your faculty, adjuncts, and staff.</p>
<p style="font-size: 16px">All the best,</p>
<p style="font-weight: bold; font-size: 18px;"> M’hammed Abdous </p>';


$options = array_merge($default_options, $options);

?>
<style>
    .html-td {
        font-family: <?php echo $options['font_family']?>;
        font-size: <?php echo $options['font_size']?>px;
        color: <?php echo $options['font_color']?>;
    }

</style>
<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
    <tr>
        <td width="100%" valign="top" align="center" inline-class="html-td">
            <?php echo $options['html'] ?>

        </td>
    </tr>

</table>
