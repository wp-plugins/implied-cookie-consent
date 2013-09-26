<?php

function icc_activation(){
    $cookie_message = __( 'This site uses cookies. <a href="/cookies">Find out more about this site&rsquo;s cookies.</a> [icc_dismiss]' );

    $cookie_page_name =  __( 'Cookies' );
    $cookie_page_content = '<h1>Cookies</h1>
<p>This site uses cookies. Most websites do this. Our cookies aren\'t used to identify you personally, they\'re here to make the site work better and allow us to analyse how it\'s being used. You can delete these cookies as you wish, but some aspects of the site may not work correctly without cookies.</p>
<p>To learn more about cookies and how to manage them, visit <a href="http://aboutcookies.org">AboutCookies.org</a>.</p>
<h3>Specific Cookies Used</h3>
<ul>
    <li>Google Analiyics Cookies &mdash; These cookies are used to track how people use the site. These cookies include _utma, _utmb, _utmc, and _utmz.</li>
    <li>Account Cookies &mdash; If you have an account or comment on this site, cookies are used verify you are the same person when you are logged in, and your preferences. These include cookies beginning with wordpress_ and wp-settings-.</li>
    <li>Cookie Message &mdash; Once you have been informed about cookies, a cookie is stored to track that you have seen the message, and it won\'t be shown again. This cookie is named icc_cookie_message.
</ul>
<p><strong>This page should be completed by the website admin...</strong></p>';

    // Setup default options
    $opt_name = 'implied_cookie_consent';
    $options = get_option( $opt_name );
    if ( !is_array( $options ) ) {
        $options = array(
            'message' => $cookie_message,
            'bgcolor' => '#dddddd',
        );
        update_option( $opt_name, $options );
    }

    // Create cookies page
    $cpage = get_page_by_title ( $cookie_page_name );
    if ( !$cpage ) {
        global $user_ID;
        $page = array();
        $page['post_type']    = 'page';
        $page['post_title']   = $cookie_page_name;
        $page['post_content'] = $cookie_page_content;
        $page['post_parent']  = 0;
        $page['post_author']  = $user_ID;
        $page['post_status']  = 'publish';
        $pageid = wp_insert_post ( $page );
    }

}


add_action( 'admin_enqueue_scripts', function() {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script('wp-color-picker');

    wp_register_script('implied_cookie_consent_admin_js', plugins_url('icc-admin.js', __FILE__ ));
    wp_enqueue_script('implied_cookie_consent_admin_js');
});


add_filter( 'plugin_action_links', function($links, $file){
    if ( $file == 'implied-cookie-consent/implied-cookie-consent.php' ) {
        array_unshift( $links, '<a href="' . admin_url('options-general.php?page=implied-cookie-consent.php') . '">Settings</a>' );
    }
    return $links;
}, 10, 2 );
  

add_action('admin_menu', function(){
    add_options_page("Implied Cookie Consent Options", "Implied Cookie Consent", 'manage_options', 'implied-cookie-consent.php', function(){
        
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }

        $opt_name = 'implied_cookie_consent';
        $opt_message_name = 'icc_message';
        $opt_bgcolor_name = 'icc_bgcolor';
        $hidden_field_name = 'icc_form_hidden';

        $options = get_option( $opt_name );

        if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
            $options['message'] = wp_kses_stripslashes( $_POST[ $opt_message_name ] );
            $options['bgcolor'] = $_POST[ $opt_bgcolor_name ];
            update_option( $opt_name, $options );
            echo '<div class="updated"><p><strong>' . __( 'Options saved.', 'implied-cookie-consent' ) . '</strong></p></div>';
        }
?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2><?php echo __( 'Implied Cookie Consent Options', 'implied-cookie-consent' ); ?></h2>

            <form name="icc_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
                <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y"> 

                <p>
                    <label for="<?php echo $opt_message_name; ?>"><?php _e("Cookie info message displayed to the user (optionally use the [icc_dismiss] shortcode to add a dismiss button): ", 'implied-cookie-consent'); ?></label><br>
                    <textarea name="<?php echo $opt_message_name; ?>" cols="80" rows="3"><?php echo $options['message']; ?></textarea>
                </p>
                <p>
                    <label for="<?php echo $opt_bgcolor_name; ?>"><?php _e("Cookie info message background color: ", 'implied-cookie-consent'); ?></label><br>
                    <input type="text" name="<?php echo $opt_bgcolor_name; ?>" value="<?php echo $options['bgcolor']; ?>" size="20" class="icc_color_field">
                </p>

                <?php submit_button(); ?>
            </form>  
        </div>  
<?php
    });
});
