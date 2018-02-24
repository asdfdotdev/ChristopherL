<?php
/**
 * Functions Toolbox - The brains of the operation.
 *
 * @package ChristopherL.com
 * @copyright 2016-2018 ChristopherL (https://github.com/christopherldotcom)
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */


/**
 * Configure Smarty settings in use globally on all pages, including directory paths, and global $config
 */
function smarty_scaffolding() {
    global $smarty, $config;

    if (!$smarty || !$config) {
        return false;
    }

    // if we're compressing the output load the plugin
    if ($config['compress']) {
        require_once('include/libs/smarty/plugins/outputfilter.trimwhitespace.php');
    }

    // Initialize Smarty settings from $config
    $smarty->setTemplateDir($config['smarty']['template_dir']);
    $smarty->setCompileDir($config['smarty']['compile_dir']);
    $smarty->setCacheDir($config['smarty']['cache_dir']);
    $smarty->caching = $config['smarty']['cache'];
    $smarty->cache_lifetime = $config['smarty']['cache_lifetime'];
    $smarty->debugging = $config['smarty']['debug'];

    // Initialize Page settings from $config
    $smarty->assign('site_version', $config['site_version']);
    $smarty->assign('css_version', hash_file('sha1', 'css/styles.css'));
    $smarty->assign('js_version', hash_file('sha1', 'js/global.min.js'));
    $smarty->assign('site_domain', $config['site_domain']);
    $smarty->assign('site_root', $config['site_root']);
    $smarty->assign('image_root', complete_url('', 1));
    $smarty->assign('a_b_testing', $config['a_b_testing']);
    $smarty->assign('google_analytics_id', $config['google_analytics_id']);
    $smarty->assign('addthis_id', $config['addthis_id']);
    $smarty->assign('optimizely_id', $config['optimizely_id']);
    $smarty->assign('hotjar_id', $config['hotjar_id']);
    $smarty->assign('compress', $config['compress']);
    $smarty->assign('google_verification', $config['google_verification']);
    $smarty->assign('bing_verification', $config['bing_verification']);
    $smarty->assign('google_plus_url', $config['google_plus_url']);

    if ($config['schema']['type'] == 0) {
        $config['schema']['type'] = 'Organization';
    }
    else {
        $config['schema']['type'] = 'Person';
    }

    $smarty->assign('schema', $config['schema']);
}


/**
 * Prepare content for use in page by removing comments, compressing whitespace, and removing line breaks.
 *
 * @param string $content  page content being processed
 *
 * @return boolean|string  page content compressed, or not, based on $config setting, false if config or content is null
 */
function smarty_content($content) {
    global $config;

    // if we don't have $config settings, or $content is empty, return false
    if (!$config || !$content) {
        return false;
    }
    // if global config setting to compress is off don't do anything
    else if (!$config['compress']) {
        return $content;
    }

    // remove single line comments (causes execution errors when compressed)
    $content = preg_replace('#^\s*//.+$#m', "", $content);

    // compress extra whitespace (makes source prettier)
    $content = preg_replace('/\s+/', ' ', $content);

    // remove line breaks (where the real smooshing happens)
    $content = preg_replace("/[\n\r]/","", trim($content));

    return $content;
}


/**
 * If $config['compress'] is active, output compression notice HTML comment and activate Smarty plugin to trim whitespace.
 */
function smarty_smoosh() {
    global $smarty, $config;

    if ($config['compress']) {

        // We're compressing the page, so let them know it's about performance not about "protecting" the source.
        echo "<!--
    Compressed for performance, not obfuscation.
    Site source released under GNU GPL 2.0 (http://www.gnu.org/licenses/gpl-2.0.html)
    Download: https://github.com/christopherldotcom/ChristopherL
-->
";

        $smarty->loadFilter('output', 'trimwhitespace');
    }
}


/**
 * Prepare form submission for use by converting multidimensional array to associative array containing:
 * $key = input name, $value = submitted value
 *
 * @param array $data   array of serialized form data
 *
 * @return array|bool   return prepared array, false if form submission is blank
 */
function package_form_submission($data=array()) {

    // if submission isn't an array, or is an empty array abort
    if ( !is_array($data) || count($data) == 0 ) {
        return false;
    }

    $form = array();
    foreach ($data as $form_input) {

        // process array data
        if ( is_array($form_input['value']) ) {
            // trim excess spaces and convert smart quotes
            $value = array_map('trim', $form_input['value']);
            $value = array_map('convert_smart_quotes', $value);

            // filter array values
            $value = filter_var_array($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        }
        // process single value data
        else {
            // trim excess spaces and convert smart quotes
            $value = trim($form_input['value']);
            $value = convert_smart_quotes($value);

            // filter value
            $value = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        }

        // trim excess spaces
        $name = trim($form_input['name']);

        // filter name
        $name = filter_var($form_input['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

        // package it up
        $form[$name] = $value;
    }

    return $form;
}


/**
 * Set AJAX response values with error details.
 *
 * @param string $message   feedback message to display in page
 * @param string $field     id of input to highlight with error css class
 * @param $response         reference to ajax.php $response array
 */
function set_response_error($message='', $field='', &$response) {
    $response['status'] = '500';
    $response['success'] = false;
    $response['error'] = true;
    $response['field'] = $field;
    $response['msg'] = $message;
}


/**
 * Set AJAX response values with feedback details.
 *
 * @param string $message   feedback message to display in page
 * @param $response         reference to ajax.php $response array
 */
function set_response_feedback($message='', &$response) {
    $response['status'] = '200';
    $response['success'] = true;
    $response['error'] = false;
    $response['msg'] = $message;
}


/**
 * Footer CTA used throughout the site.
 *
 * @return string           markup required for newsletter subscription
 */
function newsletter_subscribe() {
    return <<<HTML
    <section class="center">
        <div class="the-outer-limits">
            <h3>Lets Be Bffs</h3>
            <p>Don't let your browser have all the fun. Get your inbox involved.</p>
            
            <div id="mc_embed_signup">
            <form action="//christopherl.us13.list-manage.com/subscribe/post?u=5bb70e8892ebb1819c98306da&amp;id=922ca4bccd" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" novalidate>
                <div id="mc_embed_signup_scroll">
                
                <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_5bb70e8892ebb1819c98306da_922ca4bccd" tabindex="-1" value=""></div>
                <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                </div>
            </form>
            </div>
            <!--End mc_embed_signup-->
        </div>
    </section>
HTML;

}

/**
 * Construct complete url based on current settings.
 *
 * @param $path             Path to resource from root
 * @param $domain           Domain to use (0 = use site domain, 1 = use CDN domain)
 *
 * @return string           Complete URL to resource
 */
function complete_url($path, $domain) {
    global $config;

    if ($domain == 0 || $config['cdn_domain'] == '') {
        $base_url = $config['site_domain'] . $config['site_root'];
    }
    else {
        $base_url = $config['cdn_domain'] . $config['site_root'];
    }

    return $base_url . $path;
}

/**
 * Make smart quotes more intelligent (by replacing them).
 *
 * @param $string           Content with smart quotes that need to be replaced.
 *
 * @return mixed            Content with quotes replace.
 */
function convert_smart_quotes($string) {
    $dirty_quotes = array(chr(145), chr(146), chr(147), chr(148), chr(151), "“", "”", "‘", "’");
    $clean_quotes = array("'", "'", '"', '"', '-', '"', '"', "'", "'");

    return str_replace($dirty_quotes, $clean_quotes, $string);
}
