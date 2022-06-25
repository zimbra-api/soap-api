<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\AuthToken;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AuthToken.
 */
class AuthTokenTest extends ZimbraTestCase
{
    public function testAuthToken()
    {
        $value = $this->faker->uuid;
        $lifetime = mt_rand(1, 100);
        $token = new AuthToken($value, FALSE, $lifetime);
        $this->assertSame($value, $token->getValue());
        $this->assertFalse($token->getVerifyAccount());
        $this->assertSame($lifetime, $token->getLifetime());

        $token = new AuthToken('');
        $token->setValue($value)
            ->setVerifyAccount(TRUE)
            ->setLifetime($lifetime);
        $this->assertSame($value, $token->getValue());
        $this->assertTrue($token->getVerifyAccount());
        $this->assertSame($lifetime, $token->getLifetime());

        $xml = <<<EOT
<?xml version="1.0"?>
<result verifyAccount="true" lifetime="$lifetime">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($token, 'xml'));
        $this->assertEquals($token, $this->serializer->deserialize($xml, AuthToken::class, 'xml'));
    }
}
