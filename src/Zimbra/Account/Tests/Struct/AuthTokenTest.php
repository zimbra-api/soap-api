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
        $token = new AuthToken($value, false);
        $this->assertSame($value, $token->getValue());
        $this->assertFalse($token->getVerifyAccount());

        $token->setVerifyAccount(true);
        $this->assertTrue($token->getVerifyAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<authToken verifyAccount="true">' . $value . '</authToken>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $token);

        $array = [
            'authToken' => [
                'verifyAccount' => true,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $token->toArray());
    }
}
