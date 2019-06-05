<?php

/**
 * NSU Headers
 *
 * @package     NSU Headers
 * @author      nsu.ro
 * @copyright   2019 nsu.ro
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: NSU Headers
 * Plugin URI:
 * Description: Set headers for security and other purposes.
 * Version:     1.0.0
 * Author:      nsu.ro
 * Author URI:  https://nsu.ro
 * Text Domain: nsu-headers
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 */

// Block direct access to file
defined( 'ABSPATH' ) or die( 'Not Authorized!' );

// Plugin Defines
define( "NSU_H_FILE", __FILE__ );
define( "NSU_H_DIRECTORY", dirname(__FILE__) );
define( "NSU_H_TEXT_DOMAIN", dirname(__FILE__) );
define( "NSU_H_DIRECTORY_BASENAME", plugin_basename( NSU_H_FILE ) );
define( "NSU_H_DIRECTORY_PATH", plugin_dir_path( NSU_H_FILE ) );
define( "NSU_H_DIRECTORY_URL", plugins_url( null, NSU_H_FILE ) );

// Require the main class file
require_once( NSU_H_DIRECTORY . '/include/main-class.php' );
