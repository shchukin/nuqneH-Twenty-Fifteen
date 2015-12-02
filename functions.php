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

?>