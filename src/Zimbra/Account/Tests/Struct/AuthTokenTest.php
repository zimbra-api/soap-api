<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\AuthToken;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AuthToken.
 */
class AuthTokenTest extends ZimbraStructTestCase
{
    public function testAuthToken()
    {
        $value = $this->faker->uuid;
        $lifetime = mt_rand(1, 100);
        $token = new AuthToken($value, false, $lifetime);
        $this->assertSame($value, $token->getValue());
        $this->assertFalse($token->getVerifyAccount());
        $this->assertSame($lifetime, $token->getLifetime());

        $token = new AuthToken('');
        $token->setValue($value)
            ->setVerifyAccount(true)
            ->setLifetime($lifetime);
        $this->assertSame($value, $token->getValue());
        $this->assertTrue($token->getVerifyAccount());
        $this->assertSame($lifetime, $token->getLifetime());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<authToken verifyAccount="true" lifetime="' . $lifetime . '">' . $value . '</authToken>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($token, 'xml'));

        $token = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\AuthToken', 'xml');
        $this->assertSame($value, $token->getValue());
        $this->assertTrue($token->getVerifyAccount());
        $this->assertSame($lifetime, $token->getLifetime());
    }
}
