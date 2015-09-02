<?php
namespace OCA\PasswordPolicy\Controller;
use OCA\PasswordPolicy\Service;
use OCA\PasswordPolicy\Service\PasswordPolicyService;
use OCP\IRequest;
use OCP\AppFramework\Controller;
use OCP\IConfig;

class PasswordPolicyController extends Controller {

    private $service;

    public function __construct($AppName, IRequest $request, \OCP\IL10N $trans){
	parent::__construct($AppName, $request);
		
	$ocConfig = \OC::$server->getConfig();
	$this->service = new PasswordPolicyService($ocConfig,'passwordpolicy');
	$this->request = $request;
        $this->trans = $trans;
    }
    
    public function validatepassword($password){
	$response = array();
        $error = '';

	if(strlen($password) < intval($this->service->getAppValue('minlength')))
	{
	    $error .= $this->trans->t('Password is too short. ');
	}
	
	if($this->service->getAppValue('hasnumbers') === "true")
	{
	    if(preg_match("/[0-9]/",$password)!==1)
	    {
		$error .= $this->trans->t('Password does not contain numbers. ');
	    }
	}

	if($this->service->getAppValue('hasspecialchars') === "true")
	{
	    $specialcharslist = $this->service->getAppValue('specialcharslist');
	    if(!checkSpecialChars($specialcharslist, $password))
	    {
		$error .= $this->trans->t('Password does not contain special characters. ');
	    }
	}
	
	if($this->service->getAppValue('hasmixedcase') === "true")
	{
	    if(!checkMixedCase($password))
	    {
		$error .= $this->trans->t('Password does not contain upper and lower case characters.');
	    }
	}

	
	if(!empty($error))
	{
            $errormsg = $this->trans->t('Password does not conform to the Password Policy. [%s]', [ $error ]);
	    if($this->request->server['PATH_INFO'] === "/settings/personal/changepassword"){
		$response = array('status' => "Failure", 'data' => array('message'=>"$errormsg"));
	    } else {
		$response = array('status' => "Failure", 'msg' => "$errormsg");
	    }
	}
	
	return $response;
    }
    
    public function savepolicy($minlength, $hasmixedcase, $hasnumbers, $hasspecialchars, $specialcharslist)
    {
	\OCP\User::checkAdminUser();
	
	$hasspecialchars = $hasspecialchars===false?"false":"true";
	$hasmixedcase = $hasmixedcase===false?"false":"true";
	$hasnumbers = $hasnumbers===false?"false":"true";
	
	$this->service->setAppValue('minlength', $minlength);
	$this->service->setAppValue('hasmixedcase', $hasmixedcase);
	$this->service->setAppValue('hasnumbers', $hasnumbers);
	$this->service->setAppValue('hasspecialchars', $hasspecialchars);
	$this->service->setAppValue('specialcharslist', $specialcharslist);
	
	return true;
    }
}

function checkSpecialChars($special, $input)
{
        for($i=0;$i<strlen($special);$i++)
        {
                $x=substr ($special, $i, 1);
                if(strstr($input,$x))
                {
                        return true;
                }
        }
        return false;
}

function checkMixedCase($input)
{
        if(strtoupper($input) === $input || strtolower($input) === $input)
                return false;
        else
                return true;
}
