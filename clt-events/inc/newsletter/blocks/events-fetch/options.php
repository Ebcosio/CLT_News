<?php
/*
 * @var $options array contains all the options the current block we're ediging contains
 * @var $controls NewsletterControls
 * @var $fields NewsletterFields
 */

$default_options = array(
    'block_background'=>'#ffffff',

);

$options = array_merge($default_options, $options);
?>

<style>
    #options-json {
        display: none;
    }
</style>
<p>Note: clicking "apply" <em>or</em> "cancel" above will refetch and rerender the events.</p>
<div class="tnp-field-row">
    <div class="tnp-field-col-2">
        <?php $fields->text('start_date', 'Start date') ?>
    </div>
    <div class="tnp-field-col-2">
        <?php $fields->text('end_date', 'End date') ?>
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
   

</table>


<?php $fields->block_commons() ?>
