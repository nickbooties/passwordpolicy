<?php
namespace OCA\PasswordPolicy\AppInfo;
use \OCP\AppFramework\App;
use OCA\PasswordPolicy\Hooks\PasswordPolicyHooks;
use OCA\PasswordPolicy\Appinfo;
use OCA\PasswordPolicy\Appinfo\Application;

\OCP\App::registerAdmin('passwordpolicy','admin');
\OCP\App::registerPersonal('passwordpolicy', 'personal');

//\OCP\Util::connectHook('OC_User', 'pre_setPassword', 'OCA\PasswordPolicy\Hooks\PasswordPolicyHooks', 'pre_setPassword');

$app = new Application();
$app->getContainer()->query('PasswordPolicyHooks')->register();