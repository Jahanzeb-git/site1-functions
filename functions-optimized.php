<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @package Astra Child
 */

/**
 * Optimize CSS and JS loading with proper dependencies and conditionals
 */
function astra_child_enqueue_styles() {
    // Parent theme stylesheet
    wp_enqueue_style(
        'astra-parent-style',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme('astra')->get('Version') // Use parent theme version for cache busting
    );

    // Child theme stylesheet
    wp_enqueue_style(
        'astra-child-style',
        get_stylesheet_uri(),
        array('astra-parent-style'),
        wp_get_theme()->get('Version') // Use current theme version for cache busting
    );

    // Only load Font Awesome on pages that need it (footer is on all pages)
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
        array(),
        '5.15.4',
        'all'
    );

    // Preload Font Awesome for better performance
    add_action('wp_head', function() {
        echo '<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" as="style">';
    });

    // Only enqueue popup script on pages that need it
    if (is_page(array('bike-pricing', 'car-pricing', 'boat-pricing'))) {
        wp_enqueue_script(
            'popup-script',
            get_stylesheet_directory_uri() . '/js/popup.js',
            array('jquery'),
            filemtime(get_stylesheet_directory() . '/js/popup.js'), // Dynamic version based on file modification time
            true
        );
    }
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
 * Inject custom footer markup into Astra's footer.
 * Now with schema markup for better SEO.
 */
function vinvarify_custom_footer_markup() {
    ?>
    <footer class="site-footer" id="colophon" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
        <div class="vinvarify-footer-wrapper">
            <div class="footer-container">
                <!-- Footer Info -->
                <div class="footer-info">
                    <h2 class="footer-logo">
                        <i class="fas fa-shield-alt footer-logo-icon" aria-hidden="true"></i>
                        Vin<span>Varify</span>
                    </h2>
                    <p class="footer-description">
                        VinVarify is your trusted partner for comprehensive Vehicle Identification Number verification services.
                        We provide detailed and accurate reports for cars, motorcycles, and boats.
                    </p>
                    <div class="service-icons">
                        <div class="service-icon"><i class="fas fa-car" aria-hidden="true"></i></div>
                        <div class="service-icon"><i class="fas fa-motorcycle" aria-hidden="true"></i></div>
                        <div class="service-icon"><i class="fas fa-ship" aria-hidden="true"></i></div>
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
                        <li><i class="fas fa-envelope" aria-hidden="true"></i> <a href="mailto:support@vinvarify.com">support@vinvarify.com</a></li>
                        <li><i class="fas fa-phone-alt" aria-hidden="true"></i> +1 800-123-4567</li>
                        <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i> 1234 VIN Street, Auto City, CA, USA</li>
                        <li><i class="fas fa-clock" aria-hidden="true"></i> Mon - Fri: 9:00 AM - 6:00 PM</li>
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
                        <li><a href="https://www.facebook.com/vinvarify" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.twitter.com/vinvarify" target="_blank" rel="noopener noreferrer" aria-label="Twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.instagram.com/vinvarify" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/vinvarify" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
                <div class="footer-copy">
                    <p>© <?php echo date('Y'); ?> VinVarify. All rights reserved. Created by
                        <a href="https://jahanzebahmed.netlify.app" target="_blank" rel="noopener noreferrer">Jahanzeb Ahmed</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <?php
}

/**
 * Social proof notifier - optimized for performance
 * - Uses localStorage instead of cookies for better performance
 * - Lazy-loaded styles and improved animation performance
 * - Reduced DOM updates and layout thrashing
 */
function vinvarify_social_proof_notifier() {
    ?>
    <!-- Social Proof Notifier (Optimized) -->
    <div class="social-proof-container" id="social-proof">
      <div class="social-proof-notification" style="display:none;">
        <div class="notification-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24" aria-hidden="true">
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
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" height="16" aria-hidden="true">
            <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/>
          </svg>
        </button>
      </div>
    </div>
    <script>
      // Add social proof script at the end of content loading, but don't block rendering
      document.addEventListener('DOMContentLoaded', function() {
        // Add styles dynamically to prevent render blocking
        const style = document.createElement('style');
        style.textContent = `
          .social-proof-container{position:fixed;bottom:20px;left:20px;width:320px;z-index:9999;font-family:'Poppins',sans-serif}
          .social-proof-notification{display:flex;align-items:center;background:#fff;border-radius:12px;box-shadow:0 8px 16px rgba(0,0,0,.12),0 4px 8px rgba(0,0,0,.06);padding:12px 16px;margin-top:32px;opacity:0;transform:translateY(20px);transition:opacity .4s,transform .4s;position:relative;will-change:transform,opacity}
          .notification-close{position:absolute;right:10px;top:50%;transform:translateY(-50%);background:#f3f4f6;border:none;width:24px;height:24px;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#6b7280;padding:0}
          .notification-close:hover{background:#e5e7eb}
          .notification-icon{background:#ebf5ff;color:#0057ff;width:42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin-right:12px;flex-shrink:0}
          .notification-content{flex:1;padding-right:30px}
          .notification-message{margin:0;font-size:14px;color:#1f2937}
          .notification-time{margin:4px 0 0;font-size:12px;color:#6b7280}
          .customer-name{font-weight:600;color:#111827}
          .customer-location{color:#374151}
          .product-name{font-weight:600;color:#0057ff}
        `;
        document.head.appendChild(style);
        
        // Initialize after a short delay to prioritize main content rendering 
        setTimeout(initSocialProof, 3000);
        
        function initSocialProof() {
          // Use localStorage instead of cookies (better performance)
          function getLocal(name) {
            return localStorage.getItem(name);
          }
          
          function setLocal(name, value) {
            localStorage.setItem(name, value);
          }

          // Check if widget was dismissed globally
          if (getLocal('social_proof_dismissed') === 'true') {
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
          
          const container = document.getElementById('social-proof');
          if (!container) return; // Safety check
            
          const notification = container.querySelector('.social-proof-notification'),
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
            
            // Batch DOM updates to prevent layout thrashing
            requestAnimationFrame(() => {
              nameEl.textContent = c.name;
              locEl.textContent = c.location;
              prodEl.textContent = c.product;
              const mins = Math.floor(Math.random()*5)+1;
              timeEl.textContent = mins + ' minute' + (mins>1?'s':'') + ' ago';
              
              notification.style.display = 'flex';
              
              // Force reflow before adding animation classes
              void notification.offsetWidth;
              
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
            
            // Set random delay for next notification (between 45-180 seconds on slow connections)
            const delay = (Math.floor(Math.random() * 135) + 45) * 1000;
            
            // Use setTimeout with limited precision for better performance on slow devices
            nextTimeout = setTimeout(showNotification, delay);
          }
          
          // Handle close button click - use passive event listener for better performance
          closeBtn.addEventListener('click', () => {
            clearTimeout(hideTimeout);
            clearTimeout(nextTimeout);
            hideNotification();
            
            // Set localStorage to remember user preference
            setLocal('social_proof_dismissed', 'true');
          }, {passive: true});
          
          // Initial delay before first notification (10-30 seconds on slow connections)
          const initialDelay = (Math.floor(Math.random() * 20) + 10) * 1000;
          setTimeout(showNotification, initialDelay);
        }
      });
    </script>
    <?php
}
// Lower priority makes this load after critical content
add_action('wp_footer','vinvarify_social_proof_notifier', 30);

/**
 * Users can choose Different Package by clicking link 'Change Package' on checkout page.
 */
add_action('woocommerce_before_checkout_form', 'custom_checkout_change_package_link');
function custom_checkout_change_package_link() {
    // Cache WC cart instance for performance
    $cart = WC()->cart;
    if (!$cart) return;
    
    $cart_items = $cart->get_cart();
    $pricing_page = '/services'; // Default fallback
    
    if (!empty($cart_items)) {
        // Get the first cart item (assumes cart is cleared before adding a new product)
        $cart_item = reset($cart_items);
        if (isset($cart_item['data']) && is_object($cart_item['data'])) {
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
                <i class="fas fa-users" aria-hidden="true"></i>
                <span>Trusted by 10,000+ Customers</span>
            </div>
            <div class="trust-signal-divider"></div>
            <div class="trust-signal-item">
                <i class="fas fa-lock" aria-hidden="true"></i>
                <span>Secure Checkout</span>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Clearing Cart every time user clicks 'Checkout' button! so that only latest selection will be selected for checkout.
 * Optimized to only run when necessary.
 */
add_filter('woocommerce_add_to_cart_validation', 'custom_clear_cart_before_add', 10, 3);
function custom_clear_cart_before_add($passed, $product_id, $quantity) {
    $cart = WC()->cart;
    
    // Verify cart exists and has items before clearing
    if ($cart && $cart->get_cart_contents_count() > 0) {
        $cart->empty_cart();
    }
    
    // Return $passed to allow the new product to be added
    return $passed;
}

/**
 * Redirect add-to-cart actions directly to checkout with proper sanitization.
 */
function vinvarify_redirect_add_to_cart_to_checkout($url) {
    // Only redirect if explicitly adding to cart
    if (isset($_REQUEST['add-to-cart']) && !empty($_REQUEST['add-to-cart'])) {
        return wc_get_checkout_url();
    }
    return $url;
}
add_filter('woocommerce_add_to_cart_redirect', 'vinvarify_redirect_add_to_cart_to_checkout');

/**
 * Remove the default add-to-cart success notice.
 */
function vinvarify_remove_add_to_cart_notice($notice, $product_id) {
    return '';
}
add_filter('wc_add_to_cart_message_html', 'vinvarify_remove_add_to_cart_notice', 10, 2);

/**
 * Prevent the "View cart" button from appearing in notices.
 * More efficient regex for performance
 */
add_filter('woocommerce_add_to_cart_message_html', function($message) {
    // Strip any anchor tags in the message with optimized regex
    return preg_replace('/<a[^>]*>[^<]*<\/a>/', '', $message);
});

/**
 * Custom Time Sent to Email to User for selected Package.
 * Added caching to avoid redundant operations.
 */
add_action('woocommerce_email_after_order_table', 'add_delivery_time_to_email', 10, 4);
function add_delivery_time_to_email($order, $sent_to_admin, $plain_text, $email) {
    if ($email->id === 'customer_processing_order') {
        // Get cached result if available
        $cache_key = 'order_delivery_message_' . $order->get_id();
        $delivery_message = wp_cache_get($cache_key);
        
        if ($delivery_message === false) {
            $delivery_message = '';
            $items = $order->get_items();
            
            foreach ($items as $item) {
                $product_name = $item->get_name();
                
                // Use more efficient string checking
                if (false !== stripos($product_name, 'Silver')) {
                    $delivery_message = 'Your report will be delivered within 2 days.';
                    break;
                } elseif (false !== stripos($product_name, 'Gold')) {
                    $delivery_message = 'Your report will be delivered within 1 day.';
                    break;
                } elseif (false !== stripos($product_name, 'Platinum')) {
                    $delivery_message = 'Your report will be delivered within 12 hours.';
                    break;
                } elseif (false !== stripos($product_name, 'Boat Verification')) {
                    $delivery_message = 'Your report will be delivered within 3 days.';
                    break;
                }
            }
            
            // Cache the result for future use
            wp_cache_set($cache_key, $delivery_message, '', 3600); // Cache for 1 hour
        }
        
        if (!empty($delivery_message)) {
            if ($plain_text) {
                echo $delivery_message . "\n";
            } else {
                echo '<p>' . esc_html($delivery_message) . '</p>';
            }
        }
    }
}

// Add Report URL field to order admin page
add_action('woocommerce_admin_order_data_after_order_details', 'add_report_url_field');
function add_report_url_field($order) {
    woocommerce_wp_text_input(array(
        'id' => '_report_url',
        'label' => __('Report URL', 'woocommerce'),
        'description' => __('Enter the URL of the verification report.', 'woocommerce'),
        'desc_tip' => true,
        'value' => get_post_meta($order->get_id(), '_report_url', true),
    ));
}

// Save the Report URL field
add_action('woocommerce_process_shop_order_meta', 'save_report_url_field');
function save_report_url_field($order_id) {
    if (!empty($_POST['_report_url'])) {
        update_post_meta($order_id, '_report_url', esc_url_raw($_POST['_report_url']));
    }
}

// Add Report URL to completed order email
add_action('woocommerce_email_after_order_table', 'add_report_url_to_email', 10, 4);
function add_report_url_to_email($order, $sent_to_admin, $plain_text, $email) {
    if ($email->id === 'customer_completed_order') {
        $report_url = get_post_meta($order->get_id(), '_report_url', true);
        if ($report_url) {
            if ($plain_text) {
                echo "Your verification report is available at: " . esc_url($report_url) . "\n";
            } else {
                echo '<p>Your verification report is available at: <a href="' . esc_url($report_url) . '">Download Report</a></p>';
            }
        }
    }
}

/**
 * Add modal HTML to footer with lazy loading for PDF
 */
add_action('wp_footer', 'add_pdf_popup_modal');
function add_pdf_popup_modal() {
    // Only include on pages that need it
    if (!is_page(array('bike-pricing', 'car-pricing', 'boat-pricing'))) {
        return;
    }
    ?>
    <div id="pdf-popup" class="pdf-popup" style="display:none;">
        <div class="pdf-popup-content">
            <div class="pdf-popup-header">
                <h2 class="pdf-popup-title">Sample Bike Verification Report</h2>
                <span class="pdf-popup-close">×</span>
            </div>
            <div class="pdf-placeholder">Loading PDF...</div>
            <div class="pdf-iframe-container" data-pdf-src="<?php echo esc_url(home_url('/wp-content/uploads/2025/04/sample-report.pdf')); ?>"></div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get popup elements
        const popupTriggers = document.querySelectorAll('.show-sample-report');
        const popup = document.getElementById('pdf-popup');
        if (!popup || popupTriggers.length === 0) return;
        
        const container = popup.querySelector('.pdf-iframe-container');
        const pdfSrc = container.getAttribute('data-pdf-src');
        let iframeLoaded = false;
        
        // Lazy load PDF only when popup is opened
        function loadPdfIframe() {
            if (!iframeLoaded && pdfSrc) {
                const iframe = document.createElement('iframe');
                iframe.className = 'pdf-iframe';
                iframe.src = pdfSrc;
                iframe.title = "Sample verification report PDF";
                
                // Replace placeholder with iframe
                container.innerHTML = '';
                container.appendChild(iframe);
                iframeLoaded = true;
                
                // Remove placeholder after iframe loads
                iframe.onload = function() {
                    const placeholder = popup.querySelector('.pdf-placeholder');
                    if (placeholder) placeholder.style.display = 'none';
                };
            }
        }
        
        // Show popup handler
        popupTriggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                popup.style.display = 'block';
                loadPdfIframe(); // Load PDF when popup opens
            }, {passive: false});
        });
        
        // Close popup handler
        const closeBtn = popup.querySelector('.pdf-popup-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                popup.style.display = 'none';
            }, {passive: true});
        }
        
        // Close on outside click
        popup.addEventListener('click', function(e) {
            if (e.target === popup) {
                popup.style.display = 'none';
            }
        }, {passive: true});
    });
    </script>
    <style>
    .pdf-popup {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.8);
        z-index: 9999;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .pdf-popup.show {
        opacity: 1;
    }
    .pdf-popup-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        width: 90%;
        max-width: 900px;
        max-height: 90vh;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .pdf-popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }
    .pdf-popup-title {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }
    .pdf-popup-close {
        font-size: 24px;
        cursor: pointer;
        line-height: 1;
    }
    .pdf-placeholder {
        padding: 20px;
        text-align: center;
        background: #f1f3f5;
    }
    .pdf-iframe-container {
        flex: 1;
        min-height: 500px;
    }
    .pdf-iframe {
        width: 100%;
        height: 80vh;
        border: none;
    }
    @media (max-width: 768px) {
        .pdf-popup-content {
            width: 95%;
        }
        .pdf-iframe {
            height: 60vh;
        }
    }
    </style>
    <?php
}

/**
 * Add a checkbox for Privacy Policy and Terms & Conditions on the checkout page
 */
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

/**
 * Server-side validation for the Privacy Policy and Terms & Conditions checkbox
 */
add_action('woocommerce_checkout_process', 'validate_privacy_terms_checkbox');
function validate_privacy_terms_checkbox() {
    // Verify nonce before processing (security)
    if (!isset($_POST['woocommerce-process-
