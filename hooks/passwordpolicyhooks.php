<?php
namespace OCA\PasswordPolicy\Hooks;
use OCA\PasswordPolicy\Controller;
use OCA\PasswordPolicy\Controller\PasswordPolicyController;
use \OCP\IL10N;
use \OCP\AppFramework\Http;

class PasswordPolicyHooks {

    private $userManager;

    public function __construct($userManager, \OCP\IRequest $request, IL10N $trans){
        $this->userManager = $userManager;
        $this->Request = $request;
	$this->trans = $trans;
    }

    public function register() {
	$callbackPreSetPassword = function( $user, $password, $recoverPassword) {
	    $passwordpolicy = new PasswordPolicyController('passwordpolicy', $this->Request, $this->trans);

	    $response = $passwordpolicy->validatepassword($password);

	    if(isset($response['status']) && $response['status'] == 'Failure') {
		header('Content-Type: application/json');
		echo json_encode($response);
		exit();
	    }
	};
	$this->userManager->listen('\OC\User', 'preSetPassword', $callbackPreSetPassword);

	$callbackPreCreateUser = function($user, $password) {
	    $passwordpolicy = new PasswordPolicyController('passwordpolicy', $this->Request, $this->trans);

	    $response = $passwordpolicy->validatepassword($password);

	    if(isset($response['status']) && $response['status'] == 'Failure') {
		header('Content-Type: application/json');
		http_response_code(Http::STATUS_BAD_REQUEST);
		echo json_encode($response);
		exit();
	    }
	};
	$this->userManager->listen('\OC\User', 'preCreateUser', $callbackPreCreateUser);

    }

}
