<?php
/**
 * Class AjaxHandlerTest
 *
 * Tests include:
 *  testEmptyRequest            Verifies that a methodless request results in a 404 error response
 */
class AjaxHandlerTest extends PHPUnit_Framework_TestCase
{
    public function testEmptyRequest()
    {
        $request = "\$_POST['method'] = '';" . str_replace('<?php', '', file_get_contents('ajax.php'));
        ob_start();
        eval($request);
        $response = json_decode(ob_get_contents());
        ob_end_clean();

        $this->assertEquals('404', $response->status);
        $this->assertEquals('1', $response->error);
        $this->assertEquals('An Unknown Error Occurred', $response->msg);
    }
}
