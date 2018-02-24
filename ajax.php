<?php
/**
 * AJAX Request Handler - Page re[direct|fresh] is for noobs.
 *
 * @package ChristopherL.com
 * @copyright 2016-2018 ChristopherL (https://github.com/christopherldotcom)
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

require_once('include/config.inc.php');
require_once('include/functions.inc.php');

// initialize response values to defaults
$response = array(
    'status'    => '404',
    'success'   => false,
    'error'     => true,
    'field'     => null,
    'msg'       => 'An Unknown Error Occurred');

if (!empty($_POST)) {

    switch ($_POST['method']) {

        // contact form submission
        case 'contact':
            // get the code we need
            require_once('include/email.inc.php');

            // package form data up form submission data
            $form = package_form_submission($_POST['data']);

            // send message with cleaned form data
            send_contact_message($form, $response);

            break;
    }
}

http_response_code($response['status']);
echo json_encode($response);
