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

<style>
    .CodeMirror {
        height: 400px;
    }
</style>

<script>
    var templateEditor;
    jQuery(function () {
        templateEditor = CodeMirror.fromTextArea(document.getElementById("options-html"), {
            lineNumbers: true,
            mode: 'htmlmixed',
            lineWrapping: true,
            extraKeys: {"Ctrl-Space": "autocomplete"}
        });
    });
</script>

<table class="form-table">
    <tr>

        <td style="width: 100%; margin: 10px;">
            <p>
                Event title
                 <?php $controls->textarea('title') ?>
            </p>
        </td>
        <td style="width: 100%; margin: 10px;">
            <p>
                Event info
                 <?php $controls->textarea('info') ?>
            </p>
        </td>

         <td style="width: 100%; margin: 10px;">
            <p>
                Event href (enter as plain text)
                 <?php $controls->textarea('event_href') ?>
            </p>
        </td>


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
