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
    'block_padding_bottom' => 20,
    'block_background' => '#ffffff',
    'font_family' => 'Helvetica, Arial, sans-serif',
    'font_size' => 18,
    'font_color' => '#000'
);



$default_options['html'] = '<p style="font-weight: bold; font-size: 18px;"> M’hammed Abdous </p>';
$default_options['image_src'] = 'https://ecosio-dev.com/wp-content/uploads/2020/10/MA_Sig2x.png';
$default_options['height'] = '20%';
$default_options['width'] = '20%';


$options = array_merge($default_options, $options);

?>
<style>
    .html-td {
        font-family: <?php echo $options['font_family']?>;
        color: <?php echo $options['font_color']?>;
    }
    
</style>
<table width="100%" border="0" cellpadding="0" align="center" cellspacing="0">
    <tr>
        <td width="100%" valign="top" align="center" inline-class="html-td">
            <?php echo $options['html'] ?>
        </td>
    </tr>
    <tr>
        <td  valign="top" align="center" inline-class="html-td" class="html-td-global">
           <img src=<?php echo $options['image_src'] ?> height=<?php echo $options['height'] ?>   
           width=<?php echo $options['width'] ?> />
        </td>
    </tr>
</table>

