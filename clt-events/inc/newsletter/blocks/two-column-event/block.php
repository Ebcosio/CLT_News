<?php
/*
 * Name: 2 column event
 * Section: content
 * Description: event information and link
 *
 */

/* @var $options array */
/* @var $wpdb wpdb */

$default_options = array(
    'date'=>'date',
    'title'=>'event title',
    'info'=>'event information',
    'date2'=>'date',
    'title2'=>'event title',
    'info2'=>'event information',
    'html3'=>'register or get information',
    'event_href'=>'https://clt.odu.edu/events/',
    'event_href2'=>'https://clt.odu.edu/events/',
    'block_padding_left' => 15,
    'block_padding_right' => 15,
    'block_padding_top' => 5,
    'block_padding_bottom' => 5,
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
<table width="100%" cellpadding="0" align="center" cellspacing="0">
    <tr>
        <td width="50%"  align="center" inline-class="html-td" >
 
               <div style="border-right: solid #dddddd; border-right-width: 1px;">
                  <p style="font-size: 18px; font-weight: bold; min-height: 2em;"> <?php echo $options['date'] ?></p>
            <p style="font-size: 16px; line-height: 1.5; color: #0e5080; font-weight: 700; min-height: 2em;"> <?php echo $options['title'] ?> </p>
            <p style="font-size: 16px; line-height: 1;"> <?php echo $options['info'] ?> </p>
            <p><a href=<?php echo $options['event_href']  ?> target="_blank">Register or get information</a></p>

            </div>
        </td>

        <td width="50%"  align="center" inline-class="html-td">
 
               <div style="line-height: 1;">
                  <p style="font-size: 18px; font-weight: bold; min-height: 2em;"> <?php echo $options['date2'] ?></p>
            <p style="font-size: 16px; line-height: 1.5; color: #0e5080; font-weight: 700; min-height: 2em;"> <?php echo $options['title2'] ?> </p>
            <p style="font-size: 16px; line-height: 1;"> <?php echo $options['info2'] ?> </p>
            <p><a href=<?php echo $options['event_href2']  ?> target="_blank">Register or get information</a></p>

            </div>
        </td>
    </tr>


</table>



