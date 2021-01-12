<?php

// Conditionally add JS to the Newsletter Plugin Block Editor screen
add_action('admin_enqueue_scripts', function($admin_page) {
    if ($admin_page === 'admin_page_newsletter_emails_composer') {
      wp_enqueue_script( 'jquery-ui-datepicker' );
    }
  });

?>
