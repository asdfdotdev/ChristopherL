<?php
/**
 * Class FunctionsIncludeTest
 *
 * Tests include:
 *  testResponseError               Verifies error is set in response correctly
 *  testResponseFeedback            Verifies feedback is set in response correctly
 *  testPackageFormSubmission       Verifies correct form submission filtering and packaging
 */
class FunctionsIncludeTest extends PHPUnit_Framework_TestCase
{
    public function testResponseError()
    {
        require_once('include/config.inc.php');
        require_once('include/functions.inc.php');

        // sample default response
        $response = array(
            'status'    => '404',
            'success'   => false,
            'error'     => true,
            'field'     => null,
            'msg'       => 'An Unknown Error Occurred');

        // create error
        set_response_error('You broke it good.', 'my_error_field', $response);

        $this->assertEquals('500', $response['status']);
        $this->assertFalse($response['success'], 'Response success should be false when setting error.');
        $this->assertTrue($response['error'], 'Response error should be true when setting error.');
        $this->assertEquals('my_error_field', $response['field']);
        $this->assertEquals('You broke it good.', $response['msg']);
    }

    public function testResponseFeedback()
    {
        require_once('include/config.inc.php');
        require_once('include/functions.inc.php');

        // sample default response
        $response = array(
            'status'    => '404',
            'success'   => false,
            'error'     => true,
            'field'     => null,
            'msg'       => 'An Unknown Error Occurred');

        // create feedback
        set_response_feedback('Hey, I think that worked.', $response);

        $this->assertEquals('200', $response['status']);
        $this->assertTrue($response['success'], 'Response success should be true when setting feedback.');
        $this->assertFalse($response['error'], 'Response error should be false when setting feedback.');
        $this->assertEquals(null, $response['field']);
        $this->assertEquals('Hey, I think that worked.', $response['msg']);
    }

    public function testPackageFormSubmission()
    {
        // example serialized form submission
        $test_data = array(
            // clean data, values should not change
            array(  'name'  => 'clean_text_input',
                    'value' => 'Hello World.'
            ),
            array(  'name'  => 'clean_email_input',
                    'value' => 'fakeemail@domain.tld'
            ),
            array(  'name'  => 'clean_array_input',
                    'value' => array('thing 1', 'thing 2', 'thing 3')
            ),

            // quoted data, quotes should be encoded when cleaned
            array(  'name'  => 'double_quote_input',
                    'value' => '"quote me on it"'
            ),
            array(  'name'  => 'single_quote_input',
                    'value' => '\'quote me on it\''
            ),
            array(  'name'  => 'quoted_array_input',
                    'value' => array('"quote me on it"', '\'quote me on it\'', 'this is a “smart” quote which is funny because they aren‘t very ‘smart’')
            ),

            // clean data with extra leading/trailing spaces, values should be trimed of excess whitespace
            array(  'name'  => 'spaces_text_input',
                    'value' => '  Hello World.  '
            ),
            array(  'name'  => 'spaces_email_input',
                    'value' => '  fakeemail@domain.tld  '
            ),
            array(  'name'  => 'spaces_array_input',
                    'value' => array('  thing 1  ', '  thing 2  ', '  thing 3  ')
            ),

            // poluted data, values should be cleaned of unneccessary tags
            array(  'name'  => 'polluted_text_input',
                'value' => '  <div><b><i>Hello</i> <span>World.</span></b></div>  '
            ),
            array(  'name'  => 'polluted_email_input',
                'value' => '  <div><b><i>fakeemail</i>@<span>domain</span>.tld</b></div>  '
            ),
            array(  'name'  => 'polluted_array_input',
                'value' => array('  <div class="my-class">thing 1</div>  ', '  <div id="my_id">thing 2</div>  ', '  <p><b><i><u>thing 3</p>  ')
            ),

            // junk data, values should be empty because there's nothing useful here
            array(  'name'  => 'junk_open_tag_input',
                'value' => '  <div><b><i><span><fake_tag><open_tags_only>  '
            ),
            array(  'name'  => 'junk_close_tag_input',
                'value' => '  </div></b></i></span></fake_tag></close_tags_only>  '
            ),
            array(  'name'  => 'junk_array_input',
                'value' => array('  <div class="my-class"></div>  ', '  <div id="my_id"></div>  ', '  <p><b><i><u>  ')
            ),

            // malicious JavaScript data, values should be cleaned and harmless
            array(  'name'  => 'malicious_js_text_input',
                'value' => '       <script>window.location.href = "http://christopherl.com";</script>'
            ),
            // text input above obfuscated with https://www.javascriptobfuscator.com/Javascript-Obfuscator.aspx
            array(  'name'  => 'malicious_js_obfuscated_input',
                'value' => '< script >var _0x5e97=["\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70\x3A\x2F\x2F\x63\x68\x72\x69\x73\x74\x6F\x70\x68\x65\x72\x6C\x2E\x63\x6F\x6D"];window[_0x5e97[1]][_0x5e97[0]]=_0x5e97[2]</ script >'
            ),
            array(  'name'  => 'malicious_js_array_input',
                'value' => array('       <script>\n\n\n\n\twindow.location.href = "http://christopherl.com";</script>     ', 'just kidding this is plain text', '   < script >var _0x5e97=["\x68\x72\x65\x66","\x6C\x6F\x63\x61\x74\x69\x6F\x6E","\x68\x74\x74\x70\x3A\x2F\x2F\x63\x68\x72\x69\x73\x74\x6F\x70\x68\x65\x72\x6C\x2E\x63\x6F\x6D"];window[_0x5e97[1]][_0x5e97[0]]=_0x5e97[2]</ script >  ')
            ),

            // malicious PHP data, values should be cleaned and harmless
            array(  'name'  => 'malicious_php_tagged_input',
                'value' => '<?php eval(header("Location: http:christopherl.com");?>'
            ),
            array(  'name'  => 'malicious_php_tagless_input',
                'value' => '; "\'; \'"; eval(header("Location: http:christopherl.com");'
            ),
            array(  'name'  => 'malicious_php_array_input',
                'value' => array('<?php eval(header("Location: http:christopherl.com");?>', 'just kidding this is plain text', '; eval(header("Location: http:christopherl.com");')
            ),
        );

        // send to package function for cleanup
        $cleaned_data = package_form_submission($test_data);

        // verify clean data is unchanged
        $this->assertEquals('Hello World.', $cleaned_data['clean_text_input']);
        $this->assertEquals('fakeemail@domain.tld', $cleaned_data['clean_email_input']);
        $this->assertEquals('thing 1', $cleaned_data['clean_array_input'][0]);
        $this->assertEquals('thing 2', $cleaned_data['clean_array_input'][1]);
        $this->assertEquals('thing 3', $cleaned_data['clean_array_input'][2]);

        // verify quoted data is converted and cleaned
        $this->assertEquals('&#34;quote me on it&#34;', $cleaned_data['double_quote_input']);
        $this->assertEquals('&#39;quote me on it&#39;', $cleaned_data['single_quote_input']);
        $this->assertEquals('&#34;quote me on it&#34;', $cleaned_data['quoted_array_input'][0]);
        $this->assertEquals('&#39;quote me on it&#39;', $cleaned_data['quoted_array_input'][1]);
        $this->assertEquals('this is a &#34;smart&#34; quote which is funny because they aren&#39;t very &#39;smart&#39;', $cleaned_data['quoted_array_input'][2]);

        // verify spaces data is cleaned
        $this->assertEquals('Hello World.', $cleaned_data['spaces_text_input']);
        $this->assertEquals('fakeemail@domain.tld', $cleaned_data['spaces_email_input']);
        $this->assertEquals('thing 1', $cleaned_data['spaces_array_input'][0]);
        $this->assertEquals('thing 2', $cleaned_data['spaces_array_input'][1]);
        $this->assertEquals('thing 3', $cleaned_data['spaces_array_input'][2]);

        // verify polluted data is cleaned
        $this->assertEquals('Hello World.', $cleaned_data['polluted_text_input']);
        $this->assertEquals('fakeemail@domain.tld', $cleaned_data['polluted_email_input']);
        $this->assertEquals('thing 1', $cleaned_data['polluted_array_input'][0]);
        $this->assertEquals('thing 2', $cleaned_data['polluted_array_input'][1]);
        $this->assertEquals('thing 3', $cleaned_data['polluted_array_input'][2]);

        // verify junk data is empty
        $this->assertEquals('', $cleaned_data['junk_open_tag_input']);
        $this->assertEquals('', $cleaned_data['junk_close_tag_input']);
        $this->assertEquals('', $cleaned_data['junk_array_input'][0]);
        $this->assertEquals('', $cleaned_data['junk_array_input'][1]);
        $this->assertEquals('', $cleaned_data['junk_array_input'][2]);

        // verify malicious JavaScript data is cleaned
        $this->assertEquals('window.location.href = &#34;http://christopherl.com&#34;;', $cleaned_data['malicious_js_text_input']);
        $this->assertEquals('var _0x5e97=[&#34;\x68\x72\x65\x66&#34;,&#34;\x6C\x6F\x63\x61\x74\x69\x6F\x6E&#34;,&#34;\x68\x74\x74\x70\x3A\x2F\x2F\x63\x68\x72\x69\x73\x74\x6F\x70\x68\x65\x72\x6C\x2E\x63\x6F\x6D&#34;];window[_0x5e97[1]][_0x5e97[0]]=_0x5e97[2]', $cleaned_data['malicious_js_obfuscated_input']);
        $this->assertEquals('\n\n\n\n\twindow.location.href = &#34;http://christopherl.com&#34;;', $cleaned_data['malicious_js_array_input'][0]);
        $this->assertEquals('just kidding this is plain text', $cleaned_data['malicious_js_array_input'][1]);
        $this->assertEquals('var _0x5e97=[&#34;\x68\x72\x65\x66&#34;,&#34;\x6C\x6F\x63\x61\x74\x69\x6F\x6E&#34;,&#34;\x68\x74\x74\x70\x3A\x2F\x2F\x63\x68\x72\x69\x73\x74\x6F\x70\x68\x65\x72\x6C\x2E\x63\x6F\x6D&#34;];window[_0x5e97[1]][_0x5e97[0]]=_0x5e97[2]', $cleaned_data['malicious_js_array_input'][2]);

        // verify malicious PHP data is cleaned
        $this->assertEquals('', $cleaned_data['malicious_php_tagged_input']);
        $this->assertEquals('; &#34;&#39;; &#39;&#34;; eval(header(&#34;Location: http:christopherl.com&#34;);', $cleaned_data['malicious_php_tagless_input']);
        $this->assertEquals('', $cleaned_data['malicious_php_array_input'][0]);
        $this->assertEquals('just kidding this is plain text', $cleaned_data['malicious_php_array_input'][1]);
        $this->assertEquals('; eval(header(&#34;Location: http:christopherl.com&#34;);', $cleaned_data['malicious_php_array_input'][2]);
    }
}