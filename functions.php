<?php

/*
    because wp_get_attachment_image_src() return wrong dimensions
    http://wordpress.stackexchange.com/questions/167525/why-is-wp-get-attachment-image-src-returning-wrong-dimensions
    http://wordpress.stackexchange.com/questions/48075/settings-in-media-settings-is-ignored-when-inserting-images
 */
$content_width = 1200;



/*
    widget areas
*/

function nuqneH_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Before Navigation', 'nuqneH-Twenty-Fifteen' ),
        'id'            => 'before-nav-1',
        'description'   => __( 'Duplicate of original widget area, but before navigation.', 'nuqneH-Twenty-Fifteen' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
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
?>