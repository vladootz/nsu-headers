<?php

// Block direct access to file
defined( 'ABSPATH' ) or die( 'Not Authorized!' );

class NSU_H_eaders {

    public function __construct() {

        // Plugin uninstall hook
        register_uninstall_hook( NSU_H_FILE, ['NSU_H_eaders', 'plugin_uninstall'] );

        // Plugin activation/deactivation hooks
        register_activation_hook( NSU_H_FILE, [$this, 'plugin_activate'] );
        register_deactivation_hook( NSU_H_FILE, [$this, 'plugin_deactivate'] );

        // Plugin Actions
        add_action( 'plugins_loaded', [$this, 'plugin_init'] );
        add_action( 'admin_menu', [$this, 'plugin_admin_menu_function'] );

        // Plugin meta
        add_filter( 'plugin_row_meta', [ $this, 'plugin_row_meta' ], 10, 2 );

        //
        add_action("admin_init", [ $this, 'nsu_settings_page'] );

    }

    public static function plugin_uninstall() {
    }

    /**
     * Plugin activation function
     * called when the plugin is activated
     * @method plugin_activate
     */
    public function plugin_activate() {
    }

    /**
     * Plugin deactivate function
     * is called during plugin deactivation
     * @method plugin_deactivate
     */
    public function plugin_deactivate() {
    }

    /**
     * Plugin init function
     * init the polugin textDomain
     * @method plugin_init
     */
    function plugin_init() {
        // before all load plugin text domain
        load_plugin_textDomain( NSU_H_TEXT_DOMAIN, false, dirname(NSU_H_DIRECTORY_BASENAME) . '/languages' );
    }

    function plugin_admin_menu_function() {

        // create top level submenu page which point to main menu page
        add_submenu_page( 'options-general.php', __('NSU Headers', NSU_H_TEXT_DOMAIN), __('NSU Headers', NSU_H_TEXT_DOMAIN), 'manage_options', 'nsu-headers', [$this, 'plugin_settings_page'] );

    }

    /**
     * Plugin main settings page
     * @method plugin_settings_page
     */
    function plugin_settings_page() { ?>

        <div class="wrap">
            <h1><?php _e( 'NSU Headers', NSU_H_TEXT_DOMAIN ); ?></h1>

            <div class="card">

                <p><?php _e( 'Choose which headers you want to activate:', NSU_H_TEXT_DOMAIN ); ?></p>

                <form method="post" action="options.php">
                    <?php
                    settings_fields("section");

                    do_settings_sections("nsu");

                    submit_button();
                    ?>
                </form>

            </div>
        </div>

    <?php }


    function nsu_settings_page() {
        add_settings_section("section", "Headers", null, "nsu");

        add_settings_field("nsu-x_frame_options", "X-Frame-Options", [ $this, 'nsu_x_frame_options' ], "nsu", "section");
        add_settings_field("nsu-x_xss_protection", "X-XSS-Protection", [ $this, 'nsu_x_xss_protection' ], "nsu", "section");

        register_setting("section", "nsu-x_frame_options");
        register_setting("section", "nsu-x_xss_protection");
    }

    function nsu_x_frame_options() { ?>
        <input type="checkbox" name="nsu-x_frame_options" value="1" <?php checked(1, get_option('nsu-x_frame_options'), true); ?> />
    <?php }

    function nsu_x_xss_protection() { ?>
        <input type="checkbox" name="nsu-x_xss_protection" value="1" <?php checked(1, get_option('nsu-x_xss_protection'), true); ?> />
    <?php }

	public function plugin_row_meta( $plugin_meta, $plugin_file ) {
		if ( 'nsu-headers/nsu-headers.php' === $plugin_file ) {
			$row_meta = [
				'thanks' => 'Thanks <a href="https://github.com/jamayk" target="_blank">@jamayk</a> and <a href="https://github.com/oslego" target="_blank">@oslego</a> for initial work.',
			];

			$plugin_meta = array_merge( $plugin_meta, $row_meta );
		}

		return $plugin_meta;
	}

}

new NSU_H_eaders;

/*


function add_header_x_frame($headers) {
    $headers['X-Frame-Options'] = 'sameorigin';
    return $headers;
}
add_filter( 'wp_headers', 'add_header_x_frame' );

function add_header_xss($headers) {
    $headers['X-XSS-Protection'] = '1';
    return $headers;
}
add_filter( 'wp_headers', 'add_header_xss' );

function add_header_xcontent($headers) {
    $headers['X-Content-Type-Options'] = 'nosniff';
    return $headers;
}
add_filter( 'wp_headers', 'add_header_xcontent' );

function add_header_referrer($headers) {
    $headers['Referrer-Policy'] = 'no-referrer';
    return $headers;
}
add_filter( 'wp_headers', 'add_header_referrer' );


function add_header_strict($headers) {
    $headers['Strict-Transport-Security'] = 'max-age=15768000; includeSubDomains; preload';
    return $headers;
}
add_filter( 'wp_headers', 'add_header_strict' );

function add_header_feature($headers) {
    $headers['Feature-Policy'] = 'geolocation \'self\'';
    return $headers;
}
add_filter( 'wp_headers', 'add_header_feature' );

function add_header_content($headers) {
    $headers['Content-Security-Policy'] = 'default-src \'self\'; script-src \'self\' \'unsafe-inline\' https://www.google-analytics.com https://code.jquery.com https://js.hs-analytics.net https://google-analytics.com https://ajax.googleapis.com https://www.google.com https://www.gstatic.com; frame-src \'self\' \'unsafe-inline\' https://www.google.com https://www.gstatic.com;  font-src \'self\' \'unsafe-inline\' https://fonts.googleapis.com https://fonts.gstatic.com https://maxcdn.bootstrapcdn.com; style-src \'self\' \'unsafe-inline\' https://fonts.googleapis.com https://fonts.gstatic.com https://maxcdn.bootstrapcdn.com; img-src \'self\' \'unsafe-inline\' https://www.google-analytics.com https://stats.g.doubleclick.net';
    return $headers;
}
add_filter( 'wp_headers', 'add_header_content' );


*/