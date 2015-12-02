<?php

/* widget areas */

function nuqneH_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Before Navigation', 'nuqneH-Twenty-Fifteen' ),
        'id'            => 'before-nav-1',
        'description'   => __( 'This is the area located right before primary navigation.', 'nuqneH-Twenty-Fifteen' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
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