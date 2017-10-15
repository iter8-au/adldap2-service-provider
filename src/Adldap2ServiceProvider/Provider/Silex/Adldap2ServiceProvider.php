<?php

namespace Adldap2ServiceProvider\Provider\Silex;

use Adldap\Adldap;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

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
     * @param  Container $app
     *
     * @throws \InvalidArgumentException
     * @throws \Adldap\Exceptions\AdldapException
     */
    public function register(Container $app)
    {
        $app['adldap'] = function () use ($app) {
            $defaults = [
                'port'             => 389,
                'use_ssl'          => true,
                'follow_referrals' => false,
            ];

            // Default to not auto-connecting, e.g. the connection will be made
            // when the first LDAP command is attempted.
            // https://github.com/Adldap2/Adldap2/blob/v5.2/docs/GETTING-STARTED.md
            $autoConnect = isset($app['adldap.auto_connect']) ? (boolean) $app['adldap.auto_connect'] : false;

            $config = array_merge($defaults, $app['adldap.options']);

            return new Adldap($config, null, $autoConnect);
        };
    }

}
