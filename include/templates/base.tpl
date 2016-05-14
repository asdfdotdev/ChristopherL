{*
/**
 * Base Template - Used globally for all pages.
 *
 * @package ChristopherL.com
 * @copyright 2016 ChristopherL (https://github.com/chrislarrycarl)
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */
*}
<!doctype html>
<html lang="en-US" itemscope itemtype="http://schema.org/WebPage">
<head>
    {* Basic Page Details *}
    <title>{$page_title}</title>
    <meta name="description" content="{$page_desc}" itemprop="description">
    <meta itemprop="name" content="{$page_title}">

    {* Twitter Card data *}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{$page_title}">
    <meta name="twitter:description" content="{$page_desc}">
    <meta name="twitter:creator" content="@chrislarrycarl">
    <meta name="twitter:site" content="@chrislarrycarl">
    <meta name="twitter:image" content="{$site_domain}{$site_root}{$image_twitter}">

    {* Open Graph data *}
    <meta property="og:title" content="{$page_title}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{$site_domain}{$site_root}{$page_url}">
    <meta property="og:image" content="{$site_domain}{$site_root}{$image_facebook}">
    <meta property="og:description" content="{$page_desc}">
    <meta property="og:site_name" content="ChristopherL">

    {* Misc Meta *}
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all, index, follow">
    <meta name="apple-mobile-web-app-title" content="ChristopherL">

    {* Misc Link *}
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="stylesheet" href="{$site_root}/css/styles.css?v={$version}">
    <link rel="icon" href="{$site_root}/img/favicon.png">
    <link rel="author" itemprop="author" href="{$site_domain}{$site_root}/humans.txt">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="{$site_domain}{$site_root}/sitemap.xml" />

    {*
        Only output canonical for pages with a page url, we don't set this for the 404 page so that
        "missing" pages aren't indexed.
    *}
    {if $page_url}
    <link rel="canonical" href="{$site_domain}{$site_root}{$page_url}">
    {/if}

    {* No notice if we don't compress, so let them know in the meta *}
    <meta name="copyleft" content="{date("Y")} ChristopherL">
    <meta name="license" content="GNU GPL v2">
    <meta name="download" content="https://github.com/chrislarrycarl/ChristopherL">

    {if $a_b_testing && $optimizely_id}
        <script src="https://cdn.optimizely.com/js/{$optimizely_id}.js"></script>
    {/if}

    {*
        Webmaster Tools
    *}
    <meta name="google-site-verification" content="{$google_verification}">
    <meta name="msvalidate.01" content="{$bing_verification}">

    {$head_extras}
</head>
<body>

    {$body_header_extras}

    <header>
        <a href="{$site_domain}" data-event="logo">
            <img src="{$site_root}/img/logo.png" width="200"
                alt="ChristopherL Logo"
                title="Serious Business, Since 1999">
        </a>
        <nav>
            <ul>
                <li{if $active_nav == 'home'} class="active"{/if}><a href="{$site_root}/" data-event="top-nav"><span>Home</span></a></li>
                <li{if $active_nav == 'development'} class="active"{/if}><a href="{$site_root}/development" data-event="top-nav"><span>Development</span></a></li>
                <li{if $active_nav == 'marketing'} class="active"{/if}><a href="{$site_root}/marketing" data-event="top-nav"><span>Marketing</span></a></li>
                <li{if $active_nav == 'about'} class="active"{/if}><a href="{$site_root}/about" data-event="top-nav"><span>About</span></a></li>
                <li{if $active_nav == 'contact'} class="active"{/if}><a href="{$site_root}/contact" data-event="top-nav"><span>Contact</span></a></li>
            </ul>
        </nav>
    </header>
    <div class="hero hero_{$active_nav}">&nbsp;</div>

    {$content}

    <footer>
        <div class="the-outer-limits container row">

            <div class="three columns">
                <h4>Look Around</h4>
                <ul>
                    <li><a href="{$site_root}/development" data-event="footer">Development</a></li>
                    <li><a href="{$site_root}/marketing" data-event="footer">Marketing</a></li>
                    <li><a href="{$site_root}/about" data-event="footer">About Us</a></li>
                    <li><a href="{$site_root}/contact" data-event="footer">Contact</a></li>
                </ul>
            </div>
            <div class="three columns">
                <h4>Make Friends</h4>
                <ul>
                    <li><a href="https://somafm.com/" target="_blank" data-event="footer">Soma FM</a></li>
                    <li><a href="https://timbersarmy.org/107ist/what-why" target="_blank" data-event="footer">107ist</a></li>
                {*
                    Uncomment this so people can visit Keith's site, if he ever finishes it.
                    <li><a href="http://thekloudgroup.com/" target="_blank" data-event="footer">The Kloud Group</a></li>
                *}
                    <li><a href="https://www.tsheets.com" target="_blank" data-event="footer">TSheets</a></li>
                </ul>
            </div>
            <div class="three columns">
                <h4>Waste Time</h4>
                <ul>
                    <li><a href="http://creasedcomics.com/videos" target="_blank" data-event="footer">Laugh</a></li>
                    <li><a href="http://christopherl.com/m2/" target="_blank" data-event="footer">Do Math</a></li>
                    <li><a href="https://amzn.com/w/LN1S1UZP94HA" target="_blank" data-event="footer">Go Shopping</a></li>
                    <li><a href="https://youtu.be/dQw4w9WgXcQ" target="_blank" data-event="footer">Don't Click This</a></li>
                </ul>
            </div>
            <div class="three columns">
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_horizontal_follow_toolbox"></div>
            </div>

            <div class="copyright">
                <span>&copy;</span> {date("Y")} ChristopherL - <a href="https://github.com/chrislarrycarl/ChristopherL" target="_blank" title="Download This Website">Code</a>
            </div>

            <img src="{$site_root}/img/footer-head.png"
                alt="ChristopherLs Head"
                title="Our Mascot"
                class="head">

        {if $addthis_id}
            <div class="addthis-mobile-shim hidden-desktop"></div>
        {/if}

        </div>
    </footer>

    {*
        jQuery with Subresource Integrity (SRI) attributes
        Details: https://www.srihash.org/
    *}
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>

    {*
        Global JavaScript
    *}
    <script src="{$site_root}/js/global{if $is_dev == 0}.min{/if}.js?v={$version}"></script>

    {*
        AddThis Sharing Code
    *}
    {if $addthis_id}
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid={$addthis_id}"></script>
    {/if}

    {*
        Google Analytics Tracking Code
    *}
    {if !$is_dev && $google_analytics_id}
        <script>(function(i,s,o,g,r,a,m) { i['GoogleAnalyticsObject']=r;i[r]=i[r]||function() { (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');ga('create', '{$google_analytics_id}', 'auto');ga('require', 'displayfeatures');ga('require', 'linkid', 'linkid.js');ga('send', 'pageview');</script>
    {/if}

    {*
        Hotjar Tracking Code for http://christopherl.com
    *}
    {if !$is_dev && $hotjar_id}
        <script>(function(h,o,t,j,a,r) { h.hj=h.hj||function() { (h.hj.q=h.hj.q||[]).push(arguments) } ;h._hjSettings= { hjid:{$hotjar_id},hjsv:5 } ;a=o.getElementsByTagName('head')[0];r=o.createElement('script');r.async=1;r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;a.appendChild(r); } )(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');</script>
    {/if}

    <link href='https://fonts.googleapis.com/css?family=Sacramento|Noto+Sans:400,700' rel='stylesheet' type='text/css'>

    <script type="application/ld+json"> { "@context":"http://schema.org","@type":"{$schema.type}","name":"{$schema.name}","url":"{$site_domain}{$site_root}","telephone":"{$schema.telephone}","address": { "@type":"PostalAddress","streetAddress":"{$schema.street}","addressLocality":"{$schema.city}","addressRegion":"{$schema.region}","postalCode":"{$schema.postal_code}","addressCountry":"{$schema.country}" } ,{if $schema.type == 'Person'}"jobTitle":"{$schema.job_title}","affiliation":"{$schema.employer}","additionalName":"{$schema.also_known_as}",{/if}"sameAs":["{'", "'|implode:$schema.same_as}"] } </script>

    {$body_footer_extras}

</body>
</html>