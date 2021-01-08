<?php
/* 
 * @var $options array contains all the options the current block we're ediging contains
 * @var $controls NewsletterControls 
 */

$default_options = array(
    'block_background'=>'#ffffff',
    
);

$options = array_merge($default_options, $options);
?>

<div class="tnp-field-row">
    <div class="tnp-field-col-1">
        <?php $fields->text('date', 'Event date') ?>
    </div>
</div>
<div class="tnp-field-row">
    <div class="tnp-field-col-1">
        <?php $fields->textarea('title', 'Event Title') ?>
    </div>
</div>
<div class="tnp-field-row">
    <div class="tnp-field-col-1">
        <?php $fields->text('info', 'Event info') ?>
    </div>
</div>
<div class="tnp-field-row">
    <div class="tnp-field-col-1">
        <?php $fields->url('event_href', 'Event href (must have "https://" part)') ?>
    </div>
</div>
<div class="tnp-field-row">
    <div class="tnp-field-col-1">
        <?php $fields->text('link_text', 'Link text') ?>
    </div>
</div>


<table class="form-table">
    <tr>        
        <td style="width: 100%; margin: 10px;">
         <p>Font Family (enter property value as font-family(s) and generic-family at the end): </p> <br/>
          <?php $controls->textarea('font_family') ?>
       </td>
       <td style="width: 100%; margin: 10px;">
         <p>Font size in pixels: </p> <br/>
           <?php $controls->text('font_size') ?>
       </td>
       <td style="width: 100%; margin: 10px;">
         <p>Font Color (as hex value, or html name): </p> <br/>
           <?php $controls->text('font_color') ?>
       </td>
       
    </tr>
    
    
</table>


<?php $fields->block_commons() ?>
