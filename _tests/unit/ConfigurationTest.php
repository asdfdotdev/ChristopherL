<?php
/**
 * Class ConfigurationTest
 *
 * Tests include:
 *  testConfigFileStructure         Verifies config file structure to ensure settings are named correctly
 *  testConfigFileContents          Verifies config file contents to ensure setting values are valid
 */
class ConfigurationTest extends PHPUnit_Framework_TestCase
{
    public function testConfigFileStructure()
    {
        require('include/config.inc.php');

        // verify we have the correct number of config array elements
        $this->assertEquals(19, count($config), 'Incorrect number of settings in $config array.');

        // verify config array keys are named as expected
        $this->assertTrue(array_key_exists('version', $config), '$config element version missing.');
        $this->assertTrue(array_key_exists('site_domain', $config), '$config element site_domain missing.');
        $this->assertTrue(array_key_exists('site_root', $config), '$config element site_root missing.');
        $this->assertTrue(array_key_exists('dev', $config), '$config element dev missing.');
        $this->assertTrue(array_key_exists('compress', $config), '$config element compress missing.');
        $this->assertTrue(array_key_exists('send_to_address', $config), '$config element send_to_address missing.');
        $this->assertTrue(array_key_exists('optimizely_id', $config), '$config element optimizely_id missing.');
        $this->assertTrue(array_key_exists('a_b_testing', $config), '$config element a_b_testing missing.');
        $this->assertTrue(array_key_exists('google_analytics_id', $config), '$config element google_analytics_id missing.');
        $this->assertTrue(array_key_exists('addthis_id', $config), '$config element addthis_id missing.');
        $this->assertTrue(array_key_exists('hotjar_id', $config), '$config element hotjar_id missing.');
        $this->assertTrue(array_key_exists('recaptcha_active', $config), '$config element recaptcha_active missing.');
        $this->assertTrue(array_key_exists('recaptcha_site_key', $config), '$config element recaptcha_site_key missing.');
        $this->assertTrue(array_key_exists('recaptcha_secret_key', $config), '$config element recaptcha_secret_key missing.');
        $this->assertTrue(array_key_exists('google_verification', $config), '$config element google_verification missing.');
        $this->assertTrue(array_key_exists('bing_verification', $config), '$config element bing_verification missing.');
        $this->assertTrue(array_key_exists('google_plus_url', $config), '$config element google_plus_url missing.');
        $this->assertTrue(array_key_exists('schema', $config), '$config element schema missing.');
        $this->assertTrue(array_key_exists('smarty', $config), '$config element smarty missing.');

        // verify smarty config element is an array and has the proper number of settings
        $this->assertTrue(is_array($config['smarty']), '$config smarty settings array missing.');
        $this->assertEquals(5, count($config['smarty']), 'Incorrect number of smarty settings in $config smarty array.');

        // verify smarty config array elements are named as expected
        $this->assertTrue(array_key_exists('cache', $config['smarty']), '$config smarty element cache missing.');
        $this->assertTrue(array_key_exists('debug', $config['smarty']), '$config smarty element debug missing.');
        $this->assertTrue(array_key_exists('template_dir', $config['smarty']), '$config smarty element template_dir missing.');
        $this->assertTrue(array_key_exists('compile_dir', $config['smarty']), '$config smarty element compile_dir missing.');
        $this->assertTrue(array_key_exists('cache_dir', $config['smarty']), '$config smarty element cache_dir missing.');

        // verify schema config element is an array and has the proper number of settings
        $this->assertTrue(is_array($config['schema']), '$config schema settings array missing.');
        $this->assertEquals(12, count($config['schema']), 'Incorrect number of smarty settings in $config schema array.');

        // verify smarty config array elements are named as expected
        $this->assertTrue(array_key_exists('type', $config['schema']), '$config schema element type missing.');
        $this->assertTrue(array_key_exists('name', $config['schema']), '$config schema element name missing.');
        $this->assertTrue(array_key_exists('telephone', $config['schema']), '$config schema element telephone missing.');
        $this->assertTrue(array_key_exists('street', $config['schema']), '$config schema element street missing.');
        $this->assertTrue(array_key_exists('city', $config['schema']), '$config schema element city missing.');
        $this->assertTrue(array_key_exists('region', $config['schema']), '$config schema element region missing.');
        $this->assertTrue(array_key_exists('postal_code', $config['schema']), '$config schema element postal_code missing.');
        $this->assertTrue(array_key_exists('country', $config['schema']), '$config schema element country missing.');
        $this->assertTrue(array_key_exists('same_as', $config['schema']), '$config schema element same_as missing.');
        $this->assertTrue(array_key_exists('job_title', $config['schema']), '$config schema element job_title missing.');
        $this->assertTrue(array_key_exists('employer', $config['schema']), '$config schema element employer missing.');
        $this->assertTrue(array_key_exists('also_known_as', $config['schema']), '$config schema element also_known_as missing.');
    }

    /**
     * @depends testConfigFileStructure
     */
    public function testConfigFileContents()
    {
        require('include/config.inc.php');

        // verify site_domain is a valid url
        $this->assertNotEquals(false, filter_var($config['site_domain'], FILTER_VALIDATE_URL), '$config site_domain is not a valid URL.');

        // verify Google Analytics is setup
        $this->assertNotEquals('', $config['google_analytics_id'], '$config google_analytics_id is required for analytics');

        // verify AddThis is setup
        $this->assertNotEquals('', $config['addthis_id'], '$config addthis_id is required for sharing');

        // if A/B testing is active confirm Optimizely id
        if ($config['a_b_testing']) {
            $this->assertNotEquals('', $config['optimizely_id'], '$config optimizely_id is required for A/B testing.');
        }

        if ($config['recaptcha_active']) {
            $this->assertNotEquals('', $config['recaptcha_site_key'], '$config recaptcha_site_key is required for captcha.');
            $this->assertNotEquals('', $config['recaptcha_secret_key'], '$config recaptcha_secret_key is required for captcha.');
        }
    }
}
