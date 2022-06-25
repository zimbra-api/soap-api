<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\ExchangeAuthSpec;
use Zimbra\Common\Enum\AuthScheme;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ExchangeAuthSpec.
 */
class ExchangeAuthSpecTest extends ZimbraTestCase
{
    public function testExchangeAuthSpec()
    {
        $url = $this->faker->word;
        $user = $this->faker->word;
        $pass = $this->faker->word;
        $type = $this->faker->word;

        $auth = new ExchangeAuthSpec($url, $user, $pass, AuthScheme::BASIC(), $type);
        $this->assertSame($url, $auth->getUrl());
        $this->assertSame($user, $auth->getAuthUserName());
        $this->assertSame($pass, $auth->getAuthPassword());
        $this->assertEquals(AuthScheme::BASIC(), $auth->getScheme());
        $this->assertSame($type, $auth->getType());

        $auth = new ExchangeAuthSpec('', '', '', AuthScheme::BASIC());
        $auth->setUrl($url)
             ->setAuthUserName($user)
             ->setAuthPassword($pass)
             ->setScheme(AuthScheme::FORM())
             ->setType($type);

        $this->assertSame($url, $auth->getUrl());
        $this->assertSame($user, $auth->getAuthUserName());
        $this->assertSame($pass, $auth->getAuthPassword());
        $this->assertEquals(AuthScheme::FORM(), $auth->getScheme());
        $this->assertSame($type, $auth->getType());

        $scheme = AuthScheme::FORM()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result url="$url" user="$user" pass="$pass" scheme="$scheme" type="$type" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($auth, 'xml'));
        $this->assertEquals($auth, $this->serializer->deserialize($xml, ExchangeAuthSpec::class, 'xml'));
    }
}
