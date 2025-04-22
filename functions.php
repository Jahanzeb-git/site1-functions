<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @package Astra Child
 */

// Enqueue parent & child styles
function astra_child_enqueue_styles() {
    // Parent theme stylesheet
    wp_enqueue_style(
        'astra-parent-style',
        get_template_directory_uri() . '/style.css'
    );

    // Child theme stylesheet
    wp_enqueue_style(
        'astra-child-style',
        get_stylesheet_uri(),
        array('astra-parent-style')
    );

    // Font Awesome for footer icons
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
        array(),
        '5.15.4'
    );

    // Enqueue custom JavaScript for popup
    wp_enqueue_script(
        'popup-script',
        get_stylesheet_directory_uri() . '/js/popup.js',
        array('jquery'),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'astra_child_enqueue_styles');

/**
 * Replace Astra's default footer with custom footer.
 */
function vinvarify_replace_astra_footer() {
    // Remove Astra's default footer markup
    remove_action('astra_footer', 'astra_footer_markup', 10);

    // Add custom footer
    vinvarify_custom_footer_markup();
}
add_action('astra_footer', 'vinvarify_replace_astra_footer', 5);

/**
 * Inject custom footer markup into Astra’s footer.
 */
function vinvarify_custom_footer_markup() {
    ?>
    <footer class="site-footer" id="colophon" role="contentinfo">
        <div class="vinvarify-footer-wrapper">
            <div class="footer-container">
                <!-- Footer Info -->
                <div class="footer-info">
                    <h2 class="footer-logo">
                        <i class="fas fa-shield-alt footer-logo-icon"></i>
                        Vin<span>Varify</span>
                    </h2>
                    <p class="footer-description">
                        VinVarify is your trusted partner for comprehensive Vehicle Identification Number verification services.
                        We provide detailed and accurate reports for cars, motorcycles, and boats.
                    </p>
                    <div class="service-icons">
                        <div class="service-icon"><i class="fas fa-car"></i></div>
                        <div class="service-icon"><i class="fas fa-motorcycle"></i></div>
                        <div class="service-icon"><i class="fas fa-ship"></i></div>
                    </div>
                </div>

                <!-- Footer Links -->
                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url()); ?>">Home</a></li>
                        <li><a href="<?php echo esc_url(home_url('/about')); ?>">About Us</a></li>
                        <li><a href="<?php echo esc_url(home_url('/services')); ?>">Services</a></li>
                        <li><a href="<?php echo esc_url(home_url('/pricing')); ?>">Pricing</a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact</a></li>
                        <li><a href="<?php echo esc_url(home_url('/policy')); ?>">Privacy Policy</a></li>
                        <li><a href="<?php echo esc_url(home_url('/terms')); ?>">Terms & Conditions</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="footer-contact">
                    <h4>Contact Us</h4>
                    <ul>
                        <li><i class="fas fa-envelope"></i> <a href="mailto:support@vinvarify.com">support@vinvarify.com</a></li>
                        <li><i class="fas fa-phone-alt"></i> +1 800-123-4567</li>
                        <li><i class="fas fa-map-marker-alt"></i> 1234 VIN Street, Auto City, CA, USA</li>
                        <li><i class="fas fa-clock"></i> Mon - Fri: 9:00 AM - 6:00 PM</li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="footer-newsletter">
                    <h4>Newsletter</h4>
                    <p>Subscribe to our newsletter to receive updates on vehicle verification news and special offers.</p>
                    <form class="newsletter-form" action="#" method="post">
                        <input type="email" name="newsletter_email" placeholder="Your email address" required>
                        <button type="submit">Subscribe</button>
                    </form>
                    <p class="privacy-note">
                        By subscribing, you agree to our
                        <a href="<?php echo esc_url(home_url('/policy')); ?>">Privacy Policy</a>.
                    </p>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-social">
                    <ul>
                        <li><a href="https://www.facebook.com/vinvarify" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://www.twitter.com/vinvarify" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com/vinvarify" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/vinvarify" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
                <div class="footer-copy">
                    <p>© <?php echo date('Y'); ?> VinVarify. All rights reserved. Created by
                        <a href="https://jahanzebahmed.netlify.app" target="_blank" rel="noopener">Jahanzeb Ahmed</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <?php
}

/**
 * Enqueue social‑proof notifier assets and inject markup.
 */
function vinvarify_social_proof_notifier() {
    // Only show if not already dismissed
    ?>
    <!-- Social Proof Notifier -->
    <div class="social-proof-container" id="social-proof">
      <div class="social-proof-notification" style="display:none;">
        <div class="notification-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm4-4h-8v-2h8v2zm0-4h-8V10h8v2z"/>
          </svg>
        </div>
        <div class="notification-content">
          <p class="notification-message">
            <span class="customer-name"></span> from <span class="customer-location"></span> just purchased 
            <span class="product-name"></span>
          </p>
          <p class="notification-time"></p>
        </div>
        <button class="notification-close" aria-label="Close notification">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" height="16">
            <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/>
          </svg>
        </button>
      </div>
    </div>
    <style>
      /* Container */
      .social-proof-container {
        position: fixed;
        bottom: 20px; left: 20px;
        width: 320px; z-index: 9999;
        font-family: 'Poppins', sans-serif;
      }
      /* Notification card */
      .social-proof-notification {
        display: flex; align-items: center;
        background: #fff; border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.12),0 4px 8px rgba(0,0,0,0.06);
        padding: 12px 16px; margin-top: 32px;
        opacity: 0; transform: translateY(20px);
        transition: opacity .4s, transform .4s;
        position: relative;
      }
      /* Close button - now a left arrow on the card */
      .notification-close {
        position: absolute; right: 10px; top: 50%;
        transform: translateY(-50%);
        background: #f3f4f6; border: none;
        width: 24px; height: 24px;
        border-radius: 50%; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        color: #6b7280; padding: 0;
      }
      .notification-close:hover {
        background: #e5e7eb;
      }
      .notification-icon {
        background: #ebf5ff; color: #0057ff;
        width:42px;height:42px;border-radius:50%;
        display:flex;align-items:center;justify-content:center;
        margin-right:12px;flex-shrink:0;
      }
      .notification-content {
        flex: 1;
        padding-right: 30px; /* Make space for the close button */
      }
      .notification-message { margin:0; font-size:14px; color:#1f2937; }
      .notification-time { margin:4px 0 0; font-size:12px; color:#6b7280; }
      .customer-name { font-weight:600; color:#111827; }
      .customer-location { color:#374151; }
      .product-name { font-weight:600; color:#0057ff; }
    </style>
    <script>
      (function(){
        // Get or set widget cookie state
        function getCookie(name) {
          const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
          return match ? match[2] : null;
        }
        
        function setCookie(name, value, days) {
          let expires = "";
          if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
          }
          document.cookie = name + "=" + value + expires + "; path=/";
        }

        // Check if widget was dismissed globally
        if (getCookie('social_proof_dismissed') === 'true') {
          return; // Exit if user dismissed the widget
        }

        const customers = [
          { name:"John D.",location:"New York",product:"Silver Package" },
          { name:"Sarah L.",location:"Chicago",product:"Gold Package" },
          { name:"Michael R.",location:"Los Angeles",product:"Platinum Package" },
          { name:"Emma J.",location:"Austin",product:"Gold Package" },
          { name:"David M.",location:"Boston",product:"Silver Package" },
          { name:"Olivia P.",location:"Seattle",product:"Platinum Package" },
          { name:"Liam T.",location:"Denver",product:"Gold Package" },
          { name:"Sophia K.",location:"Miami",product:"Silver Package" }
        ];
        
        const container = document.getElementById('social-proof'),
              notification = container.querySelector('.social-proof-notification'),
              nameEl = notification.querySelector('.customer-name'),
              locEl  = notification.querySelector('.customer-location'),
              prodEl = notification.querySelector('.product-name'),
              timeEl = notification.querySelector('.notification-time'),
              closeBtn = container.querySelector('.notification-close');
        
        let hideTimeout, nextTimeout, notificationCount = 0;
        const maxNotifications = 5; // Maximum notifications per session

        function showNotification(){
          // Don't show more than maxNotifications per session
          if (notificationCount >= maxNotifications) return;
          
          const c = customers[Math.floor(Math.random()*customers.length)];
          nameEl.textContent = c.name;
          locEl.textContent  = c.location;
          prodEl.textContent = c.product;
          const mins = Math.floor(Math.random()*5)+1;
          timeEl.textContent = mins + ' minute' + (mins>1?'s':'') + ' ago';

          notification.style.display = 'flex';
          requestAnimationFrame(()=>{
            notification.style.opacity = '1';
            notification.style.transform = 'translateY(0)';
          });
          notificationCount++;
          hideTimeout = setTimeout(hideNotification, 6000);
        }
        
        function hideNotification(){
          notification.style.opacity = '0';
          notification.style.transform = 'translateY(20px)';
          
          // Wait until animation completes before hiding
          setTimeout(() => {
            notification.style.display = 'none';
          }, 400);
          
          // Set random delay for next notification (between 30-120 seconds)
          const delay = (Math.floor(Math.random() * 90) + 30) * 1000;
          nextTimeout = setTimeout(showNotification, delay);
        }
        
        // Handle close button click
        closeBtn.addEventListener('click', () => {
          clearTimeout(hideTimeout);
          clearTimeout(nextTimeout);
          hideNotification();
          
          // Set cookie to remember user preference
          setCookie('social_proof_dismissed', 'true', 1); // Remember for 1 day
        });
        
        // Initial delay before first notification (random between 5-15 seconds)
        const initialDelay = (Math.floor(Math.random() * 10) + 5) * 1000;
        setTimeout(showNotification, initialDelay);
      })();
    </script>
    <?php
}
add_action('wp_footer','vinvarify_social_proof_notifier', 20);

/**
 * Users can choose Different Package by clicking link 'Change Package' on checkout page.
 */
add_action('woocommerce_before_checkout_form', 'custom_checkout_change_package_link');
function custom_checkout_change_package_link() {
    $cart_items = WC()->cart->get_cart();
    $pricing_page = '/services'; // Default fallback
    
    if (!empty($cart_items)) {
        // Get the first cart item (assumes cart is cleared before adding a new product)
        $cart_item = reset($cart_items);
        $product_name = $cart_item['data']->get_name();
        
        // Define service-to-pricing-page mappings based on actual product name format
        $service_mappings = [
            'bike_verification' => '/bike-pricing',
            'car_verification' => '/car-pricing',
            'boat_verification' => '/boat-pricing',
        ];
        
        // Check if the product name contains a known service
        foreach ($service_mappings as $service => $page) {
            if (strpos($product_name, $service) !== false) {
                $pricing_page = $page;
                break;
            }
        }
    }
    
    echo '<p>Want to choose a different package? <a href="' . esc_url(home_url($pricing_page)) . '">Change Package</a></p>';
}

/**
 * Adding Custom Trust Signal when checkout !
 */
add_action('woocommerce_checkout_before_customer_details', 'custom_checkout_trust_signal');
function custom_checkout_trust_signal() {
    ?>
    <div class="trust-signal-container">
        <div class="trust-signal-card">
            <div class="trust-signal-item">
                <i class="fas fa-users"></i>
                <span>Trusted by 10,000+ Customers</span>
            </div>
            <div class="trust-signal-divider"></div>
            <div class="trust-signal-item">
                <i class="fas fa-lock"></i>
                <span>Secure Checkout</span>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Clearing Cart every time user clicks 'Checkout' button! so that only latest selection will be selected for checkout.
 */
add_filter('woocommerce_add_to_cart_validation', 'custom_clear_cart_before_add', 10, 3);
function custom_clear_cart_before_add($passed, $product_id, $quantity) {
    // Check if the cart has any items
    if (WC()->cart->get_cart_contents_count() > 0) {
        // Clear all existing items in the cart
        WC()->cart->empty_cart();
    }
    // Return $passed to allow the new product to be added
    return $passed;
}

/**
 * Redirect add-to-cart actions directly to checkout.
 */
function vinvarify_redirect_add_to_cart_to_checkout( $url ) {
    if ( isset( $_REQUEST['add-to-cart'] ) ) {
        // Replace with your checkout URL
        return wc_get_checkout_url();
    }
    return $url;
}
add_filter( 'woocommerce_add_to_cart_redirect', 'vinvarify_redirect_add_to_cart_to_checkout' );

/**
 * Remove the default add-to-cart success notice.
 */
function vinvarify_remove_add_to_cart_notice( $notice, $product_id ) {
    return '';
}
add_filter( 'wc_add_to_cart_message_html', 'vinvarify_remove_add_to_cart_notice', 10, 2 );

/**
 * Prevent the “View cart” button from appearing in notices.
 */
add_filter( 'woocommerce_add_to_cart_message_html', function( $message ) {
    // Strip any anchor tags in the message
    return preg_replace( '/<a.*?<\/a>/', '', $message );
} );

/**
 * Custom Time Sent to Email to User for selected Package.
 */
add_action( 'woocommerce_email_after_order_table', 'add_delivery_time_to_email', 10, 4 );
function add_delivery_time_to_email( $order, $sent_to_admin, $plain_text, $email ) {
    if ( $email->id === 'customer_processing_order' ) {
        $items = $order->get_items();
        $delivery_message = '';
        foreach ( $items as $item ) {
            $product_name = $item->get_name();
            if ( strpos( $product_name, 'Silver' ) !== false ) {
                $delivery_message = 'Your report will be delivered within 2 days.';
            } elseif ( strpos( $product_name, 'Gold' ) !== false ) {
                $delivery_message = 'Your report will be delivered within 1 day.';
            } elseif ( strpos( $product_name, 'Platinum' ) !== false ) {
                $delivery_message = 'Your report will be delivered within 12 hours.';
            } elseif ( strpos( $product_name, 'Boat Verification' ) !== false ) {
                $delivery_message = 'Your report will be delivered within 3 days.';
            }
        }
        if ( $plain_text ) {
            echo $delivery_message . "\n";
        } else {
            echo '<p>' . esc_html( $delivery_message ) . '</p>';
        }
    }
}

// Add Report URL field to order admin page
add_action( 'woocommerce_admin_order_data_after_order_details', 'add_report_url_field' );
function add_report_url_field( $order ) {
    woocommerce_wp_text_input( array(
        'id' => '_report_url',
        'label' => __( 'Report URL', 'woocommerce' ),
        'description' => __( 'Enter the URL of the verification report.', 'woocommerce' ),
        'desc_tip' => true,
        'value' => get_post_meta( $order->get_id(), '_report_url', true ),
    ) );
}

// Save the Report URL field
add_action( 'woocommerce_process_shop_order_meta', 'save_report_url_field' );
function save_report_url_field( $order_id ) {
    if ( ! empty( $_POST['_report_url'] ) ) {
        update_post_meta( $order_id, '_report_url', sanitize_text_field( $_POST['_report_url'] ) );
    }
}

// Add Report URL to completed order email
add_action( 'woocommerce_email_after_order_table', 'add_report_url_to_email', 10, 4 );
function add_report_url_to_email( $order, $sent_to_admin, $plain_text, $email ) {
    if ( $email->id === 'customer_completed_order' ) {
        $report_url = get_post_meta( $order->get_id(), '_report_url', true );
        if ( $report_url ) {
            if ( $plain_text ) {
                echo "Your verification report is available at: " . $report_url . "\n";
            } else {
                echo '<p>Your verification report is available at: <a href="' . esc_url( $report_url ) . '">Download Report</a></p>';
            }
        }
    }
}

// Add modal HTML to footer
add_action('wp_footer', 'add_pdf_popup_modal');
function add_pdf_popup_modal() {
    ?>
    <div id="pdf-popup" class="pdf-popup">
        <div class="pdf-popup-content">
            <div class="pdf-popup-header">
                <h2 class="pdf-popup-title">Sample Bike Verification Report</h2>
                <span class="pdf-popup-close">×</span>
            </div>
            <iframe src="http://site2.local/wp-content/uploads/2025/04/sample-report.pdf" class="pdf-iframe"></iframe>
        </div>
    </div>
    <?php
}

// Add a checkbox for Privacy Policy and Terms & Conditions on the checkout page
add_action('woocommerce_review_order_before_submit', 'add_privacy_terms_checkbox');
function add_privacy_terms_checkbox() {
    ?>
    <div class="checkout-terms-checkbox">
        <p class="form-row terms-checkbox">
            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="terms_privacy" id="terms_privacy" />
                <span>I agree to the <a href="<?php echo esc_url(home_url('/policy')); ?>" target="_blank">Privacy Policy</a> and <a href="<?php echo esc_url(home_url('/terms')); ?>" target="_blank">Terms & Conditions</a>.</span> <span class="required">*</span>
            </label>
        </p>
    </div>
    <?php
}

// Server-side validation for the Privacy Policy and Terms & Conditions checkbox
add_action('woocommerce_checkout_process', 'validate_privacy_terms_checkbox');
function validate_privacy_terms_checkbox() {
    if (!isset($_POST['terms_privacy']) || $_POST['terms_privacy'] !== 'on') {
        wc_add_notice(__('Please agree to the Privacy Policy and Terms & Conditions to proceed.'), 'error');
    }
}

// Enqueue JavaScript and CSS for the checkout page
add_action('wp_enqueue_scripts', 'enqueue_checkout_scripts');
function enqueue_checkout_scripts() {
    if (is_checkout()) { // Only load on the checkout page
        // Enqueue JavaScript
        wp_enqueue_script(
            'checkout-terms-script',
            get_stylesheet_directory_uri() . '/js/checkout-terms.js',
            array('jquery'),
            '1.0',
            true
        );

        // Enqueue CSS
        wp_add_inline_style('astra-child-style', '
            .checkout-terms-checkbox {
                margin: 10px 0;
            }
            .terms-checkbox label {
                display: flex;
                align-items: center;
                font-size: 14px;
                color: #333;
            }
            .terms-checkbox a {
                color: #0057ff;
                text-decoration: underline;
            }
            .terms-checkbox a:hover {
                color: #003bb5;
            }
            .woocommerce-checkout #place_order:disabled {
                background-color: #cccccc;
                cursor: not-allowed;
                opacity: 0.6;
            }
            #order_review {
                margin-top: 0;
            }
        ');
    }
}
