<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$enable_checkout_login_reminder = 'yes' == get_option( 'woocommerce_enable_checkout_login_reminder', 'yes' ) ? true : false;
$is_user_logged_in = is_user_logged_in();
$show_login_step = ! $is_user_logged_in && $enable_checkout_login_reminder;

$button_class = apply_filters( 'yith_wcms_step_button_class', 'button alt yith-wcms-button' );

$labels = apply_filters( 'yith_wcms_timeline_labels', array(
        'next'     => __( 'CONTINUE', 'yith-woocommerce-multi-step-checkout' ),
        'prev'     => __( 'PREVIOUS', 'yith-woocommerce-multi-step-checkout' ),
        'login'    => _x( 'Login', 'Checkout: user timeline', 'yith-woocommerce-multi-step-checkout' ),
        'billing'  => _x( 'Billing', 'Checkout: user timeline', 'yith-woocommerce-multi-step-checkout' ),
        'shipping' => _x( 'Shipping', 'Checkout: user timeline', 'yith-woocommerce-multi-step-checkout' ),
        'order'    => _x( 'Order Info', 'Checkout: user timeline', 'yith-woocommerce-multi-step-checkout' ),
        'payment'  => _x( 'Payment Info', 'Checkout: user timeline', 'yith-woocommerce-multi-step-checkout' )
    )
);

$display = apply_filters( 'yith_wcms_timeline_display', 'horizontal' );

$timeline_args = array(
    'labels'            => $labels,
    'is_user_logged_in' => $is_user_logged_in,
    'display'           => $display,
    'style'             => get_option( 'yith_wcms_timeline_template', 'text' )
);

$timeline_template = apply_filters( 'yith_wcms_timeline_template', 'checkout-timeline.php' );

$enable_nav_button = 'yes' == get_option( 'yith_wcms_nav_buttons_enabled', 'yes' ) ? true : false;

$enable_checkout_login_reminder = 'yes' == get_option( 'woocommerce_enable_checkout_login_reminder', 'yes' ) ? true : false;

//load timeline template
function_exists( 'yith_wcms_checkout_timeline' ) && yith_wcms_checkout_timeline( $timeline_template, $timeline_args );

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );
?>

    <div id="checkout-wrapper" class="timeline-<?php echo $display ?>">
        <div id="checkout_coupon" class="woocommerce_checkout_coupon">
            <?php do_action( 'yith_woocommerce_checkout_coupon', $checkout ); ?>
        </div>
        <?php if( $enable_checkout_login_reminder ) : ?>
            <div id="checkout_login" class="woocommerce_checkout_login">
                <?php
                woocommerce_login_form(
                    array(
                        'message'  => __( 'If you have already registered, please, enter your details in the boxes below. If you are a new customer, please, go to the Billing &amp; Shipping section.', 'yith-woocommerce-multi-step-checkout' ),
                        'redirect' => wc_get_page_permalink( 'checkout' ),
                        'hidden'   => false
                    )
                ); ?>
            </div>
        <?php endif; ?>

        <?php

        // If checkout registration is disabled and not logged in, the user cannot checkout
        if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
            echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in before proceeding to checkout.', 'woocommerce' ) );
            return;
        }

        // filter hook for include new pages inside the payment method
        $get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

            <?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

                <div class="checkout_billing <?php echo $is_user_logged_in ? 'logged-in' : 'not-logged-in'; echo $enable_checkout_login_reminder ? ' show-login-reminder' : ' hide-login-reminder'; ?>" id="customer_billing_details">
                    <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
                    <?php do_action( 'woocommerce_checkout_billing' ); ?>
                </div>

                <div class="checkout_shipping" id="customer_shipping_details">
                    <?php
                    do_action( 'woocommerce_before_checkout_shipping_form' );
                    do_action( 'woocommerce_checkout_shipping' );
                    do_action( 'woocommerce_checkout_after_customer_details' );
                    ?>
                </div>

            <?php endif; ?>

            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

            <div id="order_review" class="woocommerce-checkout-review-order">
                <h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                <?php do_action( 'yith_woocommerce_checkout_order_review' ); ?>
                <input type="checkbox" name="payment_method" value="" data-order_button_text="" style="display: none;" />
            </div>

            <div id="order_checkout_payment" class="woocommerce-checkout-payment">
                <?php do_action( 'yith_woocommerce_checkout_payment' ); ?>
            </div>

            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

        </form>

        <div id="form_actions" class="<?php echo $enable_nav_button ? 'enabled' : 'disabled'; ?>" data-step="<?php echo $show_login_step ? 0 : 1; ?>">
            <input type="button" class="<?php echo $button_class ?> prev" name="checkout_prev_step" value="<?php echo $labels['prev'] ?>" data-action="prev">
            <input type="button" class="<?php echo $button_class ?> alt next" name="checkout_next_step" value="<?php echo $labels['next'] ?>" data-action="next">
        </div>
    </div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout );