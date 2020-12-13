<?php
/* @var $options array contains all the options the current block we're ediging contains */
/* @var $controls NewsletterControls */
/* @var $fields NewsletterFields */
// var_dump($fields);
?>

<p>
    Custom post types can be added using our <a href="<?php echo $extensions_url ?>" target="_blank">Advanced Composer Blocks Addon</a>.
</p>


<?php $fields->select('layout', __('Layout', 'newsletter'), array('one' => __('One column', 'newsletter'), 
    'two' => __('Two columns', 'newsletter'),
    'big-image' => __('One column, big image', 'newsletter'))) ?>


