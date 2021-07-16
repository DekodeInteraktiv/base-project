<?php
/**
 * Functions to register assets.
 *
 * @package dekode
 */

declare( strict_types=1 );
namespace Dekode\Assets;

/**
 * Enqueue shared scripts and styles
 *
 * @return void
 */
function enqueue_scripts() : void {
	/**
	 * Stylesheets
	 */
	$style_file_path = \get_template_directory() . '/build/style.css';
	if ( file_exists( $style_file_path ) ) {
		\wp_enqueue_style( 'dekode-theme-style', \get_template_directory_uri() . '/build/style.css', [], wp_get_theme()->get( 'Version' ) );
	}

	/**
	 * JavaScript
	 */
	$js_dependencies_file_path = \get_template_directory() . '/build/index.asset.php';

	if ( file_exists( $js_dependencies_file_path ) ) {
		$dependencies = require $js_dependencies_file_path;
		\wp_enqueue_script( 'dekode-theme-script', \get_template_directory_uri() . '/build/index.js', $dependencies['dependencies'], $dependencies['version'], true );
	}
}
\add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts' );

/**
 * Enqueue editor style for the WordPress editor.
 */
function editor() {
	wp_enqueue_style( 'dekode-theme-editor', get_template_directory_uri() . '/build/editor.css', [], wp_get_theme()->get( 'Version' ) );
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\editor' );
