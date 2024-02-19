<?php
/**
 * Single: Cottage
 *
 *
 * @package WordPress
 * @subpackage LeChateauDesOrmeaux
 * @since 0.0.0
 */

use Timber\{ Timber };

$templates = array( 'pages/single-cottage.html.twig' );
$data      = Timber::context();


Timber::render( $templates, $data );
