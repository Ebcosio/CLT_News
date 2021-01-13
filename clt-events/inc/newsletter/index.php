<?php

function create_newsletter_blocks() {
    if (class_exists('TNP_Composer') ) {
        // Add our blocks, one-by-one
        TNP_Composer::register_block(__DIR__ . '/blocks/register');
        TNP_Composer::register_block(__DIR__ . '/blocks/salutation-text');
        TNP_Composer::register_block(__DIR__ . '/blocks/signature-panel');
        TNP_Composer::register_block(__DIR__ . '/blocks/single-workshop');
        TNP_Composer::register_block(__DIR__ . '/blocks/clt-image');
        TNP_Composer::register_block(__DIR__ . '/blocks/two-column-event');
        TNP_Composer::register_block(__DIR__ . '/blocks/preheader-custom');
        TNP_Composer::register_block(__DIR__ . '/blocks/events-fetch');
    }
}
add_action('newsletter_register_blocks', 'create_newsletter_blocks');
    

// Conditionally add JS to the Newsletter Plugin Block Editor screen
add_action('admin_enqueue_scripts', function($admin_page) {
    if ($admin_page === 'admin_page_newsletter_emails_composer') {
      wp_enqueue_script( 'jquery-ui-datepicker' );
    }
});

?>
