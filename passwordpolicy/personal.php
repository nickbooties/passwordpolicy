<?php
use OCA\PasswordPolicy\Service;
use OCA\PasswordPolicy\Service\PasswordPolicyService;

\OCP\Util::addScript('passwordpolicy', 'user');
$tpl = new OCP\Template('passwordpolicy', 'user');

$ocConfig = \OC::$server->getConfig();
$service = new PasswordPolicyService($ocConfig,'passwordpolicy');

$minlength = $service->getAppValue('minlength');
$hasmixedcase = $service->getAppValue('hasmixedcase');
$hasnumbers = $service->getAppValue('hasnumbers');
$hasspecialchars = $service->getAppValue('hasspecialchars');
$specialcharslist = $service->getAppValue('specialcharslist');

if($hasmixedcase == "true")
{
	$tpl->assign('mixedcase',"Must contain UPPER and lower case characters.");
}
if($hasnumbers == "true")
{
	$tpl->assign('numbers',"Must contain numbers.");
}
if($hasspecialchars == "true")
{
	$tpl->assign('specialcharslist',"Must contain special characters: ".$specialcharslist);
}

$tpl->assign('minlength', $minlength);


return $tpl->fetchPage();
