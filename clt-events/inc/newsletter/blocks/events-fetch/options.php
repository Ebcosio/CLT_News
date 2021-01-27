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
    <div class="tnp-field-col-1">
        <?php $fields->text('exclude_events', 'Exclude events (by ID, comma-separated)') ?>
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

<script>
// Adds datepicker functionality. Note need for jquery-ui-datepicker dependency,
// enqueued elsewhere.
jQuery( function($) {
    $("#options-start_date").datepicker({
        dateFormat: "yy-mm-dd",
        maxDate: new Date($("#options-end_date").val())
    }).change(function(e){
        // updates the other datepicker so it can't go below this new
        // start date.
        var newMinDate = $(this).datepicker( "getDate" );
        $("#options-end_date").datepicker( "option", "minDate", newMinDate );
    });
    $("#options-end_date").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: new Date($("#options-start_date").val())
    }).change(function(e){
        // updates the other datepicker so it can't go above this new
        // end date.
        var newMaxDate = $(this).datepicker( "getDate" );
        $("#options-start_date").datepicker( "option", "maxDate", newMaxDate );
    });
} );
</script>

<?php $fields->block_commons() ?>
