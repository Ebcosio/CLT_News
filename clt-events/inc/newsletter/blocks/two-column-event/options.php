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
    <h3>Event 1</h3>
</div>
<div class="tnp-field-row">
    <div class="tnp-field-col-1">
        <?php $fields->text('date', 'Date (event 1)') ?>
    </div>
</div>
<div class="tnp-field-row">
    <div class="tnp-field-col-1">
        <?php $fields->textarea('title', 'Title (event 1)') ?>
    </div>
</div>
<div class="tnp-field-row">
    <div class="tnp-field-col-1">
        <?php $fields->text('info', 'Info text (event 1)') ?>
    </div>
</div>
<div class="tnp-field-row">
    <div class="tnp-field-col-1">
        <?php $fields->url('event_href', 'href (must have "https://" part)') ?>
    </div>
</div>
<div class="tnp-field-row">
    <div class="tnp-field-col-1">
        <?php $fields->text('link_text', 'Link text  (event 1)') ?>
    </div>
</div>

<hr>
<div class="tnp-field-row">
    <h3>Event 2</h3>
</div>

<div class="tnp-field-row">
    <div class="tnp-field-col-1">
        <?php $fields->text('date2', 'Date (event 2)') ?>
    </div>
</div>
<div class="tnp-field-row">
    <div class="tnp-field-col-1">
        <?php $fields->textarea('title2', 'Title (event 2)') ?>
    </div>
</div>
<div class="tnp-field-row">
    <div class="tnp-field-col-1">
        <?php $fields->text('info2', 'Info text (event 2)') ?>
    </div>
</div>
<div class="tnp-field-row">
    <div class="tnp-field-col-1">
        <?php $fields->url('event_href2', 'href (must have "https://" part)') ?>
    </div>
</div>
<div class="tnp-field-row">
    <div class="tnp-field-col-1">
        <?php $fields->text('link_text2', 'Link text (event 2)') ?>
    </div>
</div>
<div class="tnp-field-row">
    <h3>General</h3>
</div>
<table class="form-table">
    <tr>
       <td>
         <p>Font Family (enter property value as font-family(s) and generic-family at the end): </p> <br/>
          <?php $controls->text('font_family') ?>
       </td>
    </tr>
    <tr>
       <td>
         <p>Font size in pixels: </p> <br/>
           <?php $controls->text('font_size') ?>
       </td>
    </tr>
    <tr>
       <td>
         <p>Font Color (as hex value, or html name): </p> <br/>
           <?php $controls->text('font_color') ?>
       </td>    
    </tr>


</table>


<?php $fields->block_commons() ?>
