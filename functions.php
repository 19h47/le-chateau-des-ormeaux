<?php
/**
 * True Story functions and definitions
 *
 * @package WordPress
 * @subpackage LeChateauDesOrmeaux
 */

// Autoloader.
require_once get_template_directory() . '/vendor/autoload.php';

Timber\Timber::init();
LeChateauDesOrmeaux\Init::run_services();
