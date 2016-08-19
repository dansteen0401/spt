<?php
add_action( 'wp_enqueue_scripts', 'spt_child_theme_enqueue_styles' );
function spt_child_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

add_filter ( 'wc_add_to_cart_message', 'wc_add_to_cart_message_filter', 10, 2 );
function wc_add_to_cart_message_filter($message, $product_id = null) {
    $titles[] = get_the_title( $product_id );

    $titles = array_filter( $titles );
    $added_text = sprintf( _n( '%s has been added to your cart.', '%s have been added to your cart.', sizeof( $titles ), 'woocommerce' ), wc_format_list_of_items( $titles ) );

    $message = sprintf( '<a href="%s" class="button added_cart">%s</a><p class="added_cart_desc"> %s</p>',
                    esc_url( wc_get_page_permalink( 'cart' ) ),
                    esc_html__( 'View Cart', 'woocommerce' ),
                    esc_html( $added_text )
                    );

    return $message;
}

?>