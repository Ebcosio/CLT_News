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
    'link_text' => 'register or get information',
    'date2'=>'date',
    'title2'=>'event title',
    'info2'=>'event information',
    'link_text2' => 'register or get information',
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
       

    }


</style>
<!-- removed inner divs from table cells as of May issue  -->
<table style="width: 100%" align="center" cellspacing="0">
    
    <tr style="margin-bottom: 0;">
    <th style="font-size: 18px; font-weight: bold;"><?php echo $options['date'] ?></th>
    <th style="font-size: 18px; font-weight: bold;"><?php echo $options['date2'] ?></th>
  </tr>
    
    <tr style="margin-top: 0;">
        <td  align="center" style=" width: 50%; border-right: solid #dddddd; border-right-width: 1px; padding: 15px; margin-bottom: 20px; font-family: Helvetica, Arial, sans-serif;" >
 
               <!--<div>-->
                
            <p style="font-size: 16px; line-height: 1.5; color: #0e5080;
            font-weight: 700; min-height: 2em; margin-top: 0;"> <?php echo $options['title'] ?> </p>
            <p style="font-size: 16px; line-height: 1;"> <?php echo $options['info'] ?> </p>
            <p><a href=<?php echo $options['event_href']  ?> target="_blank"><?php echo $options['link_text'] ?></a></p>
            
         

            <!--</div>-->
        </td>

        <td align="center" style="width: 50%; line-height: 1; padding: 15px; margin-bottom: 20px; font-family: Helvetica, Arial, sans-serif;">
 
      
                
            <p style="font-size: 16px; line-height: 1.5; color: #0e5080;
            font-weight: 700; min-height: 2em; margin-top: 0;"> <?php echo $options['title2'] ?> </p>
            <p style="font-size: 16px; line-height: 1;"> <?php echo $options['info2'] ?> </p>
            <p><a href=<?php echo $options['event_href2']  ?> target="_blank"><?php echo $options['link_text2'] ?></a></p>

         
           
        </td>
    </tr>


</table>