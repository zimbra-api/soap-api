<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ExchangeAuthSpec;
use Zimbra\Enum\AuthScheme;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ExchangeAuthSpec.
 */
class ExchangeAuthSpecTest extends ZimbraStructTestCase
{
    public function testExchangeAuthSpec()
    {
        $url = $this->faker->word;
        $user = $this->faker->word;
        $pass = $this->faker->word;
        $type = $this->faker->word;

        $exc = new ExchangeAuthSpec($url, $user, $pass, AuthScheme::BASIC()->value(), $type);
        $this->assertSame($url, $exc->getUrl());
        $this->assertSame($user, $exc->getAuthUserName());
        $this->assertSame($pass, $exc->getAuthPassword());
        $this->assertSame(AuthScheme::BASIC()->value(), $exc->getScheme());
        $this->assertSame($type, $exc->getType());

        $exc = new ExchangeAuthSpec('', '', '', '');
        $exc->setUrl($url)
            ->setAuthUserName($user)
            ->setAuthPassword($pass)
            ->setScheme(AuthScheme::FORM()->value())
            ->setType($type);

        $this->assertSame($url, $exc->getUrl());
        $this->assertSame($user, $exc->getAuthUserName());
        $this->assertSame($pass, $exc->getAuthPassword());
        $this->assertSame(AuthScheme::FORM()->value(), $exc->getScheme());
        $this->assertSame($type, $exc->getType());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<auth url="' . $url . '" user="' . $user . '" pass="' . $pass . '" scheme="' . AuthScheme::FORM() . '" type="' . $type . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($exc, 'xml'));

        $exc = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\ExchangeAuthSpec', 'xml');
        $this->assertSame($url, $exc->getUrl());
        $this->assertSame($user, $exc->getAuthUserName());
        $this->assertSame($pass, $exc->getAuthPassword());
        $this->assertSame(AuthScheme::FORM()->value(), $exc->getScheme());
        $this->assertSame($type, $exc->getType());
    }
}
