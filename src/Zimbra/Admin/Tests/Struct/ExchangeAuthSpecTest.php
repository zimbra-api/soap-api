<?php declare(strict_types=1);

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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<auth url="' . $url . '" user="' . $user . '" pass="' . $pass . '" scheme="' . AuthScheme::FORM() . '" type="' . $type . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($auth, 'xml'));
        $this->assertEquals($auth, $this->serializer->deserialize($xml, ExchangeAuthSpec::class, 'xml'));

        $json = json_encode([
            'url' => $url,
            'user' => $user,
            'pass' => $pass,
            'scheme' => (string) AuthScheme::FORM(),
            'type' => $type,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($auth, 'json'));
        $this->assertEquals($auth, $this->serializer->deserialize($json, ExchangeAuthSpec::class, 'json'));
    }
}
