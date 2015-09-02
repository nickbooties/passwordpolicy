<?php
namespace OCA\PasswordPolicy;
use OCA\PasswordPolicy\Service;
use OCA\PasswordPolicy\Service\PasswordPolicyService;
use OCP\AppFramework\App;
use OCP\IContainer;

\OCP\App::checkAppEnabled('passwordpolicy');
\OCP\User::checkAdminUser();

$tpl = new \OCP\Template("passwordpolicy", "admin");
$tpl->assign('msg', 'Password Policy Enforcement');

$ocConfig = \OC::$server->getConfig();
$service = new PasswordPolicyService($ocConfig,'passwordpolicy');

// set defaults
if($service->getAppValue('minlength')===''){ $service->setAppValue('minlength','15'); }
if($service->getAppValue('hasmixedcase')===''){ $service->setAppValue('hasmixedcase','true'); }
if($service->getAppValue('hasnumbers')===''){ $service->setAppValue('hasnumbers','true'); }
if($service->getAppValue('hasspecialchars')===''){ $service->setAppValue('hasspecialchars','true'); }
if($service->getAppValue('specialcharslist')===''){ $service->setAppValue('specialcharslist','!@#$%^&*()'); }

$minlength = $service->getAppValue('minlength');
$hasmixedcase = $service->getAppValue('hasmixedcase');
$hasnumbers = $service->getAppValue('hasnumbers');
$hasspecialchars = $service->getAppValue('hasspecialchars');
$specialcharslist = $service->getAppValue('specialcharslist');

$tpl->assign('minlength', $minlength);
$tpl->assign('mixedcase', $hasmixedcase==="true"?"checked":"unchecked");
$tpl->assign('numbers', $hasnumbers==="true"?"checked":"unchecked");
$tpl->assign('specialcharacters', $hasspecialchars==="true"?"checked":"unchecked");
$tpl->assign('specialcharslist', $specialcharslist);

return $tpl->fetchPage();
