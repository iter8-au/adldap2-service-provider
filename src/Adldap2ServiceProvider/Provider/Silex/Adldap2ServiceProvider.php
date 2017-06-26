<?php

namespace Adldap2ServiceProvider\Provider\Silex;

use Adldap\Adldap;
use Silex\Application;
use InvalidArgumentException;
use Silex\ServiceProviderInterface;
use Adldap\Exceptions\AdldapException;

/**
 * Class Adldap2ServiceProvider
 *
 * The full set of Adldap2 settings are available here:
 * https://github.com/Adldap2/Adldap2/blob/master/docs/configuration.md
 *
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
        $app['adldap'] = $app->share(function () use ($app) {
            $defaults = [
                'port'             => 389,
                'use_ssl'          => true,
                'follow_referrals' => true,
            ];

            $config = array_merge($defaults, $app['adldap.options']);
			
            return new Adldap($config);
        });
    }

    /**
     * Bootstraps the application.
     *
     * @param \Silex\Application $app
     */
    public function boot(Application $app)
    {
        //
    }
}
