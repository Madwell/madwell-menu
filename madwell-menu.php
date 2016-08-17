<?php
/**
 * Plugin Name: Madwell Menu
 * Description: This plugin allows for easy editing of restaurant menus and shortcode integration with the frontend. 
 * Version: 1.3
 * Author: Madwell
 * Author URI: http://madwell.com
 */


// Register post type and taxonomy
@include 'registrations.php';

// Add custom fields
@include 'fields.php';

// Plugin functions
@include 'functions.php';