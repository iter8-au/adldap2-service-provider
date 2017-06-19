<?php

namespace Adldap2ServiceProvider\Provider\Silex;

use Adldap\Adldap;
use Silex\Application;
use InvalidArgumentException;
use Silex\ServiceProviderInterface;
use Adldap\Exceptions\AdldapException;

/**
 * Class Adldap2ServiceProvider
 * @package Adldap2ServiceProvider\Provider\Silex
 */
class Adldap2ServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given app.
     *
     * @param \Silex\Application $app
     */
    public function register(Application $app)
    {
        $app->share(function ($app) {
            try {
                $adldap = new Adldap([
                    'base_dn'            => $app['adldap.options']['baseDn'],
                    'domain_controllers' => $app['adldap.options']['servers'],
                    'use_ssl'            => $app['adldap.options']['ssl'],
                    'ad_port'            => $app['adldap.options']['port'],
                    'admin_username'     => $app['adldap.options']['adminUser'],
                    'admin_password'     => $app['adldap.options']['adminPass'],
                    'account_suffix'     => $app['adldap.options']['accountSuffix'],
                ]);
            } catch (AdldapException $e) {
                $adldap = null;
            } catch (InvalidArgumentException $e) {
                // Should never be thrown given we're supplying the configuration to adldap.
                $adldap = null;
            }

            return $adldap;
        });
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     *
     * @param \Silex\Application $app
     */
    public function boot(Application $app)
    {
        //
    }
}
