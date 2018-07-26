<?php

namespace Tests\Provider\Silex;

use Adldap\Adldap;
use Adldap2ServiceProvider\Provider\Silex\Adldap2ServiceProvider;
use Silex\Application;

/**
 * Class Adldap2ServiceProviderTest
 */
class Adldap2ServiceProviderTest extends \PHPUnit\Framework\TestCase
{
    public function testExceptionThrownWhenMissingRequiredConfiguration()
    {
        $app = new Application();

        $app->register(
            new Adldap2ServiceProvider()
        );

        $this->expectException(\BadMethodCallException::class);

        $app['adldap'];
    }

    public function testConstruct()
    {
        $app = new Application();
        $app->register(
            new Adldap2ServiceProvider(),
            [
                'adldap.options' => [
                    'username' => 'pretend_username',
                    'password' => 'pretend_password',
                ],
            ]
        );

        $this->assertInstanceOf(Adldap::class, $app['adldap']);
    }
}
