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
         <p>Font Family (enter property value as font-family(s) and generic-family at the end): </p> <br/>
           <?php $controls->textarea('font_family') ?>
       </td>
      
       <td style="width: 100%; margin: 10px;">
         <p>Font Color (as hex value, or html name): </p> <br/>
           <?php $controls->text('font_color') ?>
       </td>
       <td style="width: 100%; margin: 10px;">
         <p>Image source for signature, enter url as plain text: </p> <br/>
           <?php $controls->textarea('image_src') ?>
       </td>
       <td style="width: 100%; margin: 10px;">
         <p>Signature image height property, enter as % or px: </p> <br/>
           <?php $controls->text('height') ?>
       </td>
       <td style="width: 100%; margin: 10px;">
         <p>Signature image width property, enter as % or px: </p> <br/>
           <?php $controls->text('width') ?>
       </td>
       
        <td>
           <p>Additional inline styling can be added directly to the elements below</p>
            <?php $controls->textarea('html') ?>
            
        </td>
        
        
    </tr>
    
    
</table>


<?php $fields->block_commons() ?>
