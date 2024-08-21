<?php
/**
 * Plugin Name:       Image Hover Color
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       image-hover-color
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 ** Registers the block using the metadata loaded from the `block.json` file.
 */
function register_my_image_hover_block() {
    register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'register_my_image_hover_block' );

// Рендер-функция для генерации HTML блока
function your_render_callback_function( $attributes ) {
    $image_url = isset( $attributes['imageUrl'] ) ? esc_url( $attributes['imageUrl'] ) : '';
    $overlay_text = isset( $attributes['overlayText'] ) ? esc_html( $attributes['overlayText'] ) : 'Ваш текст';
    $image_size = isset( $attributes['imageSize']) ? intval( $attributes['imageSize'] ) : 100;

    return '<div class="image-hover-outer">
                <div class="image-hover" style="position: relative; overflow: hidden;">
                    <img class="normal-image" src="' . $image_url . '" alt="' . $overlay_text . '" style="width: ' . $image_size . '%; height: auto;" />
                    <div class="overlay">
                        <div class="overlay-content">' . $overlay_text . '</div>
                    </div>
                </div>
            </div>';
}

// Регистрация скриптов и стилей
function my_plugin_register_block_assets() {
    // Регистрируем стили для редактора и фронтенда
    wp_register_style(
        'image-hover-color-style',
        plugins_url('style.css', __FILE__)
    );

    // Регистрация скриптов для редактора
    wp_register_script(
        'my-plugin-editor-script',
        plugins_url('index.js', __FILE__),
        array( 'wp-blocks', 'wp-element', 'wp-editor' )
    );

    // Регистрируем блок с подключением стилей и скриптов
    register_block_type('create-block/image-hover-color', array(
        'editor_script' => 'my-plugin-editor-script',
        'editor_style' => 'image-hover-color-style',
        'style' => 'image-hover-color-style',
        'render_callback' => 'your_render_callback_function',
    ));
}
add_action('init', 'my_plugin_register_block_assets');