<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\ExchangeAuthSpec;
use Zimbra\Enum\AuthScheme;

/**
 * Testcase class for ExchangeAuthSpec.
 */
class ExchangeAuthSpecTest extends ZimbraAdminTestCase
{
    public function testExchangeAuthSpec()
    {
        $url = $this->faker->word;
        $user = $this->faker->word;
        $pass = $this->faker->word;
        $type = $this->faker->word;

        $exc = new ExchangeAuthSpec($url, $user, $pass, AuthScheme::BASIC(), $type);
        $this->assertSame($url, $exc->getUrl());
        $this->assertSame($user, $exc->getAuthUserName());
        $this->assertSame($pass, $exc->getAuthPassword());
        $this->assertSame('basic', $exc->getAuthScheme()->value());
        $this->assertSame($type, $exc->getType());

        $exc->setUrl($url)
            ->setAuthUserName($user)
            ->setAuthPassword($pass)
            ->setAuthScheme(AuthScheme::FORM())
            ->setType($type);

        $this->assertSame($url, $exc->getUrl());
        $this->assertSame($user, $exc->getAuthUserName());
        $this->assertSame($pass, $exc->getAuthPassword());
        $this->assertSame('form', $exc->getAuthScheme()->value());
        $this->assertSame($type, $exc->getType());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<auth url="' . $url . '" user="' . $user . '" pass="' . $pass . '" scheme="' . AuthScheme::FORM() . '" type="' . $type . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $exc);

        $array = [
            'auth' => [
                'url' => $url,
                'user' => $user,
                'pass' => $pass,
                'scheme' => AuthScheme::FORM()->value(),
                'type' => $type,
            ],
        ];
        $this->assertEquals($array, $exc->toArray());
    }
}
