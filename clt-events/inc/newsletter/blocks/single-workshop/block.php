<?php
/*
 * Name: Single Event
 * Section: content
 * Description: event information and link
 * 
 */

/* @var $options array */
/* @var $wpdb wpdb */

$default_options = array(
    'html'=>'date',
    'html1'=>'event title',
    'html2'=>'event information',
    'html3'=>'register or get information',
    'event_href'=>'',
    'block_padding_left' => 15,
    'block_padding_right' => 15,
    'block_padding_top' => 20,
    'block_padding_bottom' => 20,
    'block_background' => '#ffffff',
    'font_family' => 'Helvetica, Arial, sans-serif',
    'font_size' => 16,
    'font_color' => '#000'
);

//$default_options['html'] = '';





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
        
            <p style="font-size: 18px; font-weight: bold;"> <?php echo $options['html'] ?></p>
               <div style="line-height: 1;">
            <p style="font-size: 16px;"> <?php echo $options['html1'] ?> </p>
            <p style="font-size: 16px;"> <?php echo $options['html2'] ?> </p>
            <p><a href=<?php echo $options['event_href']  ?> target="_blank">Register or get information</a></p>
            </div>
        </td>
    </tr>
    
</table>

