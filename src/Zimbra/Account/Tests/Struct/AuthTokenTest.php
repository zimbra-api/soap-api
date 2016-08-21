<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Account\Struct\AuthToken;

/**
 * Testcase class for AuthToken.
 */
class AuthTokenTest extends ZimbraAccountTestCase
{
    public function testAuthToken()
    {
        $value = $this->faker->uuid;
        $lifetime = mt_rand(1, 100);
        $token = new AuthToken($value, false, $lifetime);
        $this->assertSame($value, $token->getValue());
        $this->assertFalse($token->getVerifyAccount());
        $this->assertSame($lifetime, $token->getLifetime());

        $token = new AuthToken($value, false, 0);
        $token->setVerifyAccount(true)
            ->setLifetime($lifetime);
        $this->assertTrue($token->getVerifyAccount());
        $this->assertSame($lifetime, $token->getLifetime());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<authToken verifyAccount="true" lifetime="' . $lifetime . '">' . $value . '</authToken>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $token);

        $array = [
            'authToken' => [
                'verifyAccount' => true,
                'lifetime' => $lifetime,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $token->toArray());
    }
}
