<?php
namespace OCA\PasswordPolicy\AppInfo;

use \OCP\AppFramework\App;
use \OCA\PasswordPolicy\Hooks\PasswordPolicyHooks;

class Application extends App {

    public function __construct(array $urlParams=array()){
        parent::__construct('passwordpolicy', $urlParams);

        $container = $this->getContainer();

        /**
         * Controllers
         */
        $container->registerService('PasswordPolicyHooks', function($c) {
            return new PasswordPolicyHooks(
		$c->query('ServerContainer')->getUserSession(),
                $c->query('Request'),
		$c->query('L10N')
            );
        });
        $container->registerService('L10N', function($c) {
            return $c->query('ServerContainer')->getL10N($c->query('AppName'));
        });
    }
}
