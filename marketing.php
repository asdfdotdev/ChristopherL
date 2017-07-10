<?php
/**
 * Marketing Page - Building a persona.
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
$cache_id = 'marketing';

if (!$smarty->isCached('base.tpl', $cache_id)) {
    smarty_scaffolding($smarty, $config);


    // Create Meta & Page Settings
    $smarty->assign('page_title', 'Inbound and Down, Since 1999 :: ChristopherL');
    $smarty->assign('page_desc', "Automation and analytics are no longer the exclusive playground of nerds. It's ChristopherL's playground. You're invited to join us on the monkey bars.");
    $smarty->assign('page_url', '/marketing');
    $smarty->assign('active_nav', 'marketing');
    $smarty->assign('hero_image', complete_url('/img/heros/marketing.jpg', 1));


    // Social Images
    $smarty->assign('image_facebook', '/img/social/marketing.jpg');
    $smarty->assign('image_twitter', '/img/social/marketing.jpg');


    // Optional Extras
    $smarty->assign('head_extras', '');
    $smarty->assign('body_header_extras', '');
    $smarty->assign('body_footer_extras', '');

    $footer_cta = newsletter_subscribe();
    $image_root = complete_url('', 1);

    // Page Content
    $content = <<<HTML
    <section class="image-right">
        <div class="the-outer-limits">
            <h1>More Than <span class="hidden-phone">Just</span> Tshirts</h1>
            <img src="{$image_root}/img/helios_history.png"
                alt="Helios Calendar Logos Through Time"
                title="A Trip Down Memory Lane"
                width="300">
            <p>
                Today's marketer is data obsessed, metric driven, and customer focused. Gone are the days of marketing simply being a means for talking at your clients. ChristopherL 
                believes good marketing is about compelling storytelling, and we know the why is a foundation for any good brand story.
            </p>
            
            <h2>Christopherl <span class="hidden-phone">For Your</span> Url</h2>
            <p>
                This isn't to say that it's all cool apps, magic quadrants, and deep dive analytics. Branding still plays a vital role in the age
                of digital marketing. Even something as rudimentary as a short url can serve as an opportunity for 
                <del>self promotion</del> improving brand awareness.
            </p>
            <p>
                Case in point, just try to resist <span class="action-desktop">clicking</span><span class="action-mobile">tapping</span> this cleverly branded link...
            </p>
            <p>
                <a href="http://christophurl.co/marketing_secrets">http://christophurl.co/marketing_secrets</a>
            </p>
        </div>
    </section>
    <section class="highlight logos">
        <div class="the-outer-limits container row">
            <div class="two columns">
                <img src="{$image_root}/img/logos/salesforce.png" alt="Salesforce Logo" height="50">
            </div>
            <div class="two columns">
                <img src="{$image_root}/img/logos/hubspot.png" alt="HubSpot Logo" height="50">
            </div>
            <div class="two columns">
                <img src="{$image_root}/img/logos/optimizely.png" alt="Optimizely Logo" height="50">
            </div>
            <div class="two columns">
                <img src="{$image_root}/img/logos/analytics.png" alt="Google Analytics Logo" height="50">
            </div>
            <div class="two columns">
                <img src="{$image_root}/img/logos/mailchimp.png" alt="MailChimp Logo" height="50">
            </div>
            <div class="two columns">
                <img src="{$image_root}/img/logos/others_marketing.png" alt="Other Marketing Tool Logos" height="50">
            </div>
        </div>
    </section>
    
    {$footer_cta}
    
    <span class="lightbox egg" data-featherlight="#fl1" data-event="marketing easter egg">:)</span>
    
    <div id="fl1" class="fl">
        <img src="{$image_root}/img/tshirts.jpg"
            alt="Helios Calendar TShirts"
            title="Softest Shirt in the World"
            width="500">
        <span>but cool tshirts are still important :)</span>
    </div>
HTML;
    $smarty->assign('content', smarty_content($content));


    // Smoosh it all down, this will make viewing the page source a pain for people
    // but will save literally 10 of milliseconds in page download time.
    smarty_smoosh();
}

// Output the page
$smarty->display('base.tpl', $cache_id);
