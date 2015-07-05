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

$tpl->assign('mixedcase',$hasmixedcase);
$tpl->assign('numbers',$hasnumbers);
$tpl->assign('specialchars',$hasspecialchars);
$tpl->assign('specialcharslist',$specialcharslist);
$tpl->assign('minlength', $minlength);


return $tpl->fetchPage();
