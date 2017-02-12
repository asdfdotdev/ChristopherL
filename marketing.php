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


// Instantiate Smarty Class and Initalize Global Config
$smarty = new Smarty();
smarty_scaffolding($smarty, $config);


// Create Meta & Page Settings
$smarty->assign('page_title', 'Inbound and Down, Since 1999 :: ChristopherL');
$smarty->assign('page_desc', "Automation and analytics are no longer the exclusive playground of nerds. It's ChristopherL's playground. You're invited to join us on the monkey bars.");
$smarty->assign('page_url', '/marketing');
$smarty->assign('active_nav', 'marketing');


// Social Images
$smarty->assign('image_facebook', '/img/social/marketing.jpg');
$smarty->assign('image_twitter', '/img/social/marketing.jpg');


// Optional Extras
$smarty->assign('head_extras', '');
$smarty->assign('body_header_extras', '');
$smarty->assign('body_footer_extras', '');

$footer_cta = newsletter_subscribe();

// Page Content (Use regex to remove newline characters.
$content = <<<HTML
    <section class="image-right">
        <div class="the-outer-limits">
            <h1>More Than <span class="hidden-phone">Just</span> Tshirts</h1>
            <img src="img/helios_history.png"
                alt="Helios Calendar Logos Through Time"
                title="A Trip Down Memory Lane"
                width="300">
            <p>
                Data obsessed, metric driven, and content focused. Modern marketing is all this and more. Gone are the days of
                marketing being a tool for simply talking to (or at) clients. We believe good marketing is about storytelling,
                and clients are an integral party of any good brand story.
            </p>
            
            <h2>Christopherl <span class="hidden-phone">For Your</span> Url</h2>
            <p>
                This isn't to say that it's all cool toys, magic quadrants, and analytics. Branding still plays a vital role in the age
                of digital marketing. Even something as rudimentary as a short url can serve as an opportunity for 
                <del>self promotion</del> improving brand awareness.
            </p>
            <p>
                Case in point, just try to resist clicking this cleverly branded link...
            </p>
            <p>
                <a href="http://christophurl.co/1VijVZs">http://christophurl.co/1VijVZs</a>
            </p>
        </div>
    </section>
    <section class="highlight logos">
        <div class="the-outer-limits container row">
            <div class="two columns">
                <img src="img/logos/salesforce.png" alt="Salesforce Logo" height="50">
            </div>
            <div class="two columns">
                <img src="img/logos/hubspot.png" alt="HubSpot Logo" height="50">
            </div>
            <div class="two columns">
                <img src="img/logos/optimizely.png" alt="Optimizely Logo" height="50">
            </div>
            <div class="two columns">
                <img src="img/logos/analytics.png" alt="Google Analytics Logo" height="50">
            </div>
            <div class="two columns">
                <img src="img/logos/mailchimp.png" alt="MailChimp Logo" height="50">
            </div>
            <div class="two columns">
                <img src="img/logos/others_marketing.png" alt="Other Marketing Tool Logos" height="50">
            </div>
        </div>
    </section>
    
    {$footer_cta}
    
    <span class="lightbox egg" data-featherlight="#fl1" data-event="marketing easter egg">:)</span>
    
    <div id="fl1" class="fl">
        <img src="img/tshirts.jpg"
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


// Output the page
$smarty->display('base.tpl', 'marketing');
