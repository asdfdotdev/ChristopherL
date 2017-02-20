<?php
/**
 * Contact Page - Reach out and touch someone.
 *
 * @package ChristopherL.com
 * @copyright 2016-2017 ChristopherL (https://github.com/chrislarrycarl)
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */


// Load Site Configuration
require_once('include/config.inc.php');
require_once('include/functions.inc.php');


// Load Smarty Library and Plugin
require_once('include/libs/smarty/Smarty.class.php');


// Instantiate Smarty Class then build page if not cached
$smarty = new Smarty();
$cache_id = 'contact';

if (!$smarty->isCached('base.tpl', $cache_id)) {
    smarty_scaffolding($smarty, $config);


    // Create Meta & Page Settings
    $smarty->assign('page_title', 'Infrequently Responding to Email, Since 1999 :: ChristopherL');
    $smarty->assign('page_desc', "There's no shortage of ways to contact ChristopherL. Except on Facebook. Don't bother with that.");
    $smarty->assign('page_url', '/contact');
    $smarty->assign('active_nav', 'contact');


    // Social Images
    $smarty->assign('image_facebook', '/img/social/contact.jpg');
    $smarty->assign('image_twitter', '/img/social/contact.jpg');


    // recaptcha elements
    $captcha_challenge = $captcha_scripts = '';

    if ($config['recaptcha_active'] && $config['recaptcha_site_key'] && $config['recaptcha_secret_key']) {
        $captcha_challenge = '<div id="g-recaptcha" class="g-recaptcha" data-sitekey="'.$config['recaptcha_site_key'].'"></div>';
        $captcha_scripts = '<script src="https://www.google.com/recaptcha/api.js"></script>';
    }

    $contact_javascript = <<<HTML
<script>
(function($){
    /*
     *  Handle contact us form submissions
     */
    $('#contact_christopherl').parsley()
        .on('form:submit', function(event) {
            event.preventDefault;
            
            // hide any errors, and feedback, from earlier attempts
            $('#contact_christopherl *').each(function(){
                $(this).removeClass('error');
            });
            $('#feedback').hide();
            
            // package it up and send to the server
            $.ajax({
                url: 'ajax.php',
                cache: false,
                method: 'post',
                dataType: 'json',
                data: { 'method':'contact', 'data':$('#contact_christopherl').serializeArray() },
            })
            .done(function(data) {
                // handle success response, reset form and recaptcha
                $('#contact_christopherl').trigger('reset');
                
                if (typeof grecaptcha !== 'undefined') {
                    grecaptcha.reset();
                }
                
                // update feedback
                $('#feedback').show();
                $('#feedback').removeClass('incomplete');
                $('#feedback').text(data.msg.toString());
                
                // track it using our global listener
                $(document).trigger('ga_track', [{type:"form_submit",identifier: data.msg.toString()}]);
                
                // hide feedback after 10 seconds
                setTimeout(function(){ 
                    $('#feedback').hide();
                }, 10000);
            })
            .fail(function(data) {
                // handle error response
                $('#feedback').show();
                $('#feedback').addClass('incomplete');
                $('#feedback').text(data.responseJSON.msg.toString());
                $('#' + data.responseJSON.field.toString()).addClass('error');
                
                // track it using our global listener
                $(document).trigger('ga_track', [{type:"form_submit",identifier: data.responseJSON.msg.toString()}]);
            });
        });
}(jQuery));
</script>
HTML;

    $smarty->assign('head_extras', '');
    $smarty->assign('body_header_extras', '');
    $smarty->assign('body_footer_extras', smarty_content($captcha_scripts . $contact_javascript));

    $footer_cta = newsletter_subscribe();

    // Page Content
    $content = <<<HTML
    <section>
        <div class="the-outer-limits">
            <h1>Connect <span class="hidden-phone">with Christopherl</span></h1>
            <aside class="contact">
                <h3>Phone</h3>
                <a href="tel:14242424711">42 42 42 4 711</a>
                <span>Yes, this number is real. And it's awesome.<br>It's real awesome.</span>
            </aside>
            <p>
                It's a small world. The human race is more interconnected now than at any point in our history,
                even still, connecting with people can be difficult. Should you wish to contact us we've rounded
                up all your options into one easy-to-use list.
            </p>
            
            <h2>Social Media</h2>
            <p>
                You can find us on 
                <a href="https://twitter.com/chrislarrycarl" target="_blank">Twitter</a>, 
                <a href="https://www.linkedin.com/in/chriscarlevato" target="_blank">LinkedIn</a>, 
                <a href="https://github.com/chrislarrycarl" target="_blank">GitHub</a>, and 
                <a href="https://www.flickr.com/photos/chrislarrycarl" target="_blank">Flickr</a>.
            </p>
            
            <h2>Good Old Email</h2>
            <p>
                But email isn't a secure medium you say?
            </p>
            <p>
                OK. Calm down Alan Westin, if it makes you feel better here's <a href="download/christopherl_public_key.asc">our public key</a>.
            </p>
            <form name="contact_christopherl" id="contact_christopherl" data-parsley-trigger="change" onsubmit="return false;">
                <fieldset>
                    <label for="fullname">Name</label>
                    <input class="form-control" id="fullname" name="fullname" type="text" required="required">
                    
                    <label for="email">Email</label>
                    <input class="form-control" id="email" name="email" required="required" type="email">
                    
                    <label for="message">What's on your mind?</label>
                    <textarea class="form-control" name="message" id="message" required="required"></textarea>
                    
                    {$captcha_challenge}
                    
                    <input id="submit" type="submit" name="submit" value="Go Button">
                </fieldset>
            </form>
            <div id="feedback" class="hidden">This is a feedback message</div>
        </div>
    </section>
    <section class="highlight logos">
        <div class="the-outer-limits container row">
            <h3>What About Facebook?</h3>
            <p>
                Yeah. Sure. If you're into <a href="https://www.facebook.com/chrislarrycarl" target="_blank" data-event="highlight-ribbon">that sort of thing</a>.
            </p>
        </div>
    </section>
    
    {$footer_cta}
HTML;
    $smarty->assign('content', smarty_content($content));


    // Smoosh it all down, this will make viewing the page source a pain for people
    // but will save literally 10 of milliseconds in page download time.
    smarty_smoosh();
}

// Output the page
$smarty->display('base.tpl', $cache_id);
