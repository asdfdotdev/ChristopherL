<?php
/**
 * Our Homepage - Where the magic happens.
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
$smarty->assign('page_title', 'Serious Business, Since 1999 :: ChristopherL');
$smarty->assign('page_desc', 'More than a homepage, ChristopherL has been serious about web development and marketing since 1999. Join us for a look at the brand behind the man.');
$smarty->assign('page_url', '/');
$smarty->assign('active_nav', 'home');


// Social Images
$smarty->assign('image_facebook', '/img/social/home.jpg');
$smarty->assign('image_twitter', '/img/social/home.jpg');


// Optional Extras
$smarty->assign('head_extras', '');
$smarty->assign('body_header_extras', '');
$smarty->assign('body_footer_extras', '');

$footer_cta = newsletter_subscribe();

// Page Content (Use regex to remove newline characters.
$content = <<<HTML
    <section class="image-right">
        <div class="the-outer-limits">
            <h1>Greetings &amp; Salutations</h1>
            <p>
                It's a big internet out there, thank you for visiting this little corner of it. Since you're here you may find yourself asking,
                <i>"What is ChristopherL?"</i> An idea? A dream? A vision? The truth? It's all these things and more.
            </p>
            <p>
                We're stoked for an opportunity to help you get to know ChristopherL better. So pull up a chair, get comfortable, 
                and <i>do it</i>.
            </p>
            <img src="img/shia.png"
                alt="Pep Talk Flexing Guy"
                title="A Little Motivation"
                width="160" 
                class="lightbox shia" 
                data-featherlight="#fl1" 
                data-event="play pep talk video">
        </div>    
    </section>
    <section class="highlight button-links">
        <div class="the-outer-limits container row">
            <div class="six columns">
                <h3>Development</h3>
                <p>
                    We call it <i>Codetry</i>&reg;, and it's about more than just good software.
                </p>
                
                <a href="development"><span class="action-desktop">Click</span><span class="action-mobile">Tap</span> to View Source</a>
            </div>
            <div class="six columns">
                <h3>Marketing</h3>
                <p>
                    Data insight and automation isn't just for nerds anymore. 
                </p>
                
                <a href="marketing"><span class="action-desktop">Click</span><span class="action-mobile">Tap</span> to Get Inbound</a>
            </div>
        </div>
    </section>
    
    {$footer_cta}
    
    <iframe src="https://www.youtube.com/embed/ZXsQAXx_ao0?showinfo=0&showsearch=0&rel=0&iv_load_policy=3&cc_load_policy=0&hd=1"
        frameborder="0"
        width="560" 
        height="315"
        allowfullscreen
        id="fl1" class="fl"></iframe>
HTML;
$smarty->assign('content', smarty_content($content));


// Smoosh it all down, this will make viewing the page source a pain for people
// but will save literally 10 of milliseconds in page download time.
smarty_smoosh();


// Output the page
$smarty->display('base.tpl');