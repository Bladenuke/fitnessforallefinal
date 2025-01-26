<?php
/**
 * Plugin Name: Fitness Login and Register
 * Description: Et plugin for innlogging, registrering og autentisering.
 * Version: 1.0
 * Author: FitnessForAlle
 */

if (!defined('ABSPATH')) exit;

// Inkluder moduler
require_once plugin_dir_path(__FILE__) . 'includes/rest-api.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';

// Legg til CSS og JS
function fitness_enqueue_assets() {
    wp_enqueue_style('fitness-styles', plugins_url('assets/style.css', __FILE__));
    wp_enqueue_script('fitness-scripts', plugins_url('assets/script.js', __FILE__), [], false, true);
}
add_action('wp_enqueue_scripts', 'fitness_enqueue_assets');
