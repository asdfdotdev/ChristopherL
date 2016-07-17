<?php
/**
 * About Page - Getting to know you.
 *
 * @package ChristopherL.com
 * @copyright 2016 ChristopherL (https://github.com/chrislarrycarl)
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
$smarty->assign('page_title', 'Not New Here, Since 1999 :: ChristopherL');
$smarty->assign('page_desc', "Sure we're a little weird, but in a 'nice once you get to know us' kind of way. So, get to know ChristopherL.");
$smarty->assign('page_url', '/about');
$smarty->assign('active_nav', 'about');


// Social Images
$smarty->assign('image_facebook', '/img/social/about.jpg');
$smarty->assign('image_twitter', '/img/social/about.jpg');


// Optional Extras
$smarty->assign('head_extras', '');
$smarty->assign('body_header_extras', '');


// Google Maps (http://www.mapstylr.com/style/subtle/)
$body_footer = <<<HTML
<script>
function initMap() {

    var window_size = $(window).width();

    if (window_size > 1024) {
        responsive_zoom = 5;
    }
    else if (window_size > 768) {
        responsive_zoom = 4;
    }
    else {
        responsive_zoom = 3;
    }

    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 44.7, lng: -101},
        scrollwheel: false,
        zoom: responsive_zoom,
        disableDefaultUI: true,
        styles: [{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"all","elementType":"all","stylers":[{"saturation":-70},{"lightness":37},{"gamma":1.15}]},{"featureType":"all","elementType":"labels","stylers":[{"visibility":"off"},{"gamma":0.26}]},{"featureType":"road","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":0},{"lightness":0},{"gamma":0}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"hue":"#ffffff"},{"saturation":0},{"lightness":50}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"on"},{"lightness":-50}]},{"featureType":"administrative.province","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"administrative.province","elementType":"labels.text","stylers":[{"lightness":20}]}]
    });
  
    var marker = new google.maps.Marker({
        position: {lat: 42.9633599, lng: -85.6680863},
        map: map,
        icon: 'img/pushpin_bw.png'
    });
    var marker = new google.maps.Marker({
        position: {lat: 45.5230622, lng: -122.6764816},
        map: map,
        icon: 'img/pushpin.png'
    });
    var marker = new google.maps.Marker({
        position: {lat: 43.6187102, lng: -116.2146068},
        map: map,
        icon: 'img/pushpin_bw.png'
    });
  
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script>
HTML;

$smarty->assign('body_footer_extras', smarty_content($body_footer));

$footer_cta = newsletter_subscribe();

// Page Content
$content = <<<HTML
    <section>
        <div class="the-outer-limits">
            <h1><span class="hidden-phone">From</span> Humble Beginings</h1>
            <p>
                ChristopherL was born in 1999.
            </p>
            <p>
                Like <a href="https://en.wikipedia.org/wiki/Pets.com" target="_blank">so many</a> 
                <a href="https://en.wikipedia.org/wiki/Yahoo!_GeoCities" target="_blank">digital ventures</a>
                <a href="https://en.wikipedia.org/wiki/Webvan" target="_blank">of that era</a> it was ambitious, a bit ahead of it's time,
                and made no money. A key distinction to fellow bubble era darlings, however, is that ChristopherL was a student homepage.
            </p>
            <p>
                Nearly 20 years, 3,000 miles, 8 revisions, and a short hiatus later <a href="https://web.archive.org/web/20160111112430*/http://christopherl.com/" target="_blank">the journey continues</a>.
            </p>
        </div>
    </section>
    <div id="map"></div>
    
    {$footer_cta}
HTML;
$smarty->assign('content', smarty_content($content));


// Smoosh it all down, this will make viewing the page source a pain for people
// but will save literally 10 of milliseconds in page download time.
smarty_smoosh();


// Output the page
$smarty->display('base.tpl');