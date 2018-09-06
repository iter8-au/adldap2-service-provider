<?php

declare(strict_types=1);

namespace Adldap2ServiceProvider\Provider\Silex;

use Adldap\Adldap;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class Adldap2ServiceProvider
 *
 * The full set of Adldap2 settings are available here:
 * https://github.com/Adldap2/Adldap2/blob/master/docs/configuration.md
 */
class Adldap2ServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given app.
     *
     * @param Container $app
     *
     * @throws \BadMethodCallException
     * @throws \InvalidArgumentException
     */
    public function register(Container $app)
    {
        $app['adldap.default_options'] = [
            'port' => 389,
            'use_ssl' => true,
            'follow_referrals' => false,
        ];
        
        if (!extension_loaded('ldap')) {
            throw new \RuntimeException('LDAP extension not loaded.');
        }

        $app['adldap'] = function ($app) {
            if (!isset($app['adldap.options']) || empty($app['adldap.options'])) {
                throw new \BadMethodCallException(
                    sprintf(
                        'adldap is missing a configuration array.'
                    )
                );
            }

            // Default to not auto-connecting, e.g. the connection will be made
            // when the first LDAP command is attempted.
            // https://github.com/Adldap2/Adldap2/blob/v5.2/docs/GETTING-STARTED.md
            $autoConnect = $app['adldap.auto_connect'] ?? false;

            $config = array_merge($app['adldap.default_options'], $app['adldap.options']);

            return new Adldap($config, null, $autoConnect);
        };
    }
}
