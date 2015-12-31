<?php

/*
    because wp_get_attachment_image_src() return wrong dimensions
    http://wordpress.stackexchange.com/questions/167525/why-is-wp-get-attachment-image-src-returning-wrong-dimensions
    http://wordpress.stackexchange.com/questions/48075/settings-in-media-settings-is-ignored-when-inserting-images
    this value should be max of all of thumbnail sizes
 */
$content_width = 1650;



/*
 *   change 1600px limitation for srcset
 */
function new_srcset_max($max_width) {
    return 1920;
}

add_filter('max_srcset_image_width', 'new_srcset_max');



/*
    register JS
*/
function nuqneH_add_script() {
    wp_enqueue_script( 'nuqneh-main', get_stylesheet_directory_uri() . '/script.js', array('jquery') );
}

add_action( 'wp_enqueue_scripts', 'nuqneH_add_script' );




/*
    widget areas
*/

function nuqneH_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'After Article', 'nuqneH-Twenty-Fifteen' ),
        'id'            => 'after-article-1',
        'description'   => __( 'Comments area', 'nuqneH-Twenty-Fifteen' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => __( 'After Post Footer', 'nuqneH-Twenty-Fifteen' ),
        'id'            => 'after-post-footer-1',
        'description'   => __( 'Good for like buttons', 'nuqneH-Twenty-Fifteen' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
}

add_action( 'widgets_init', 'nuqneH_widgets_init' );



/* 
	Removing category title from page header
	https://wordpress.org/support/topic/remove-the-word-category-before-title-of-category
 */

add_filter('gettext', 'remove_classifier_words', 20, 3);
function remove_classifier_words( $translated_text, $untranslated_text, $domain ) {

    $custom_field_text = 'Tag: %s';
    if ( !is_admin() && $untranslated_text === $custom_field_text ) {
        return '%s';
    }

    $custom_field_text = 'Category: %s';
    if ( !is_admin() && $untranslated_text === $custom_field_text ) {
        return '%s';
    }

    return $translated_text;
}



/* Category navigation counter */

function cat_count_inline($links) {
    $links = str_replace('</a> (', ' <span class="count">(', $links);
    $links = str_replace(')', ')</span></a>', $links);
    return $links;
}

add_filter('wp_list_categories', 'cat_count_inline');



/* Inline images shortcode */

function nuqneh_picture($atts, $content = null) {

    extract(shortcode_atts(array(
        'id' => '',
        'link' => 'true',
        'caption' => 'true',
        'popup' => 'true'
    ), $atts));

    $result = '';

    $picture_alt    = get_post_meta($id, '_wp_attachment_image_alt', true);



    $picture = wp_get_attachment_image_src( $id , 'post-image' );

    $picture_url    = $picture[0];
    $picture_width  = $picture[1];
    $picture_height = $picture[2];


    $picture_x2 = wp_get_attachment_image_src( $id , 'post-image-x2' );

    $picture_x2_url    = $picture_x2[0];
    $picture_x2_width  = $picture_x2[1];
    $picture_x2_height = $picture_x2[2];


    $result = '<img src="'. $picture_url .'" alt="'. $picture_alt .'" width="'. $picture_width .'" height="'. $picture_height .'"';

    return $result;


}

add_shortcode("picture", "nuqneh_picture");


/* Chrome shortcode */

function chromeWindow($atts, $content = null) {
    extract(shortcode_atts(array(
        "title" => '',
        "slug" =>'',
        "width" => '615',
        "height" => '400'
    ), $atts));

    return '<div class="chrome">
                <div class="chrome__top">
                    <div class="chrome__top__center"></div>
                    <div class="chrome__top__left"></div>
                    <div class="chrome__top__right"></div>
                </div>
                <div class="chrome__middle">
                    <div class="chrome__middle__left">
                        <div class="chrome__middle__right">
                            <iframe class="chrome__frame" height="'. $height .'" src="http://nuqneh.com/examples/'. $slug .'/index.html"></iframe>
                        </div>
                    </div>
                </div>
                <div class="chrome__bottom">
                    <div class="chrome__bottom__center"></div>
                    <div class="chrome__bottom__left"></div>
                    <div class="chrome__bottom__right"></div>
                </div>
                <div class="chrome__title">'. $title .'<div class="chrome__title__fader"></div></div>
                <div class="chrome__url">http://nuqneh.com/examples/'. $slug .'/index.html<div class="chrome__url__fader"></div></div>
                <div class="chrome__menu">
                    <a class="chrome__menu__item chrome__menu__item_download" title="Download" href="http://nuqneh.com/examples/'. $slug .'.zip"></a><!--
                 --><a class="chrome__menu__item chrome__menu__item_popup js-popup-link" title="Open in popup window" data-width="'. $width .'" data-height="'. $height .'" href="http://nuqneh.com/examples/'. $slug .'/index.html"></a><!--
                 --><a class="chrome__menu__item chrome__menu__item_window" target="_blank" title="Open in new tab" href="http://nuqneh.com/examples/'. $slug .'/index.html"></a>
                </div>
            </div>';
}

add_shortcode("chrome", "chromeWindow");


?>