<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\CheckExchangeAuthRequest;
use Zimbra\Admin\Struct\ExchangeAuthSpec;
use Zimbra\Enum\AuthScheme;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckExchangeAuthRequest.
 */
class CheckExchangeAuthRequestTest extends ZimbraStructTestCase
{
    public function testCheckExchangeAuthRequest()
    {
        $url = $this->faker->word;
        $user = $this->faker->word;
        $pass = $this->faker->word;
        $type = $this->faker->word;

        $auth = new ExchangeAuthSpec($url, $user, $pass, AuthScheme::FORM(), $type);
        $req = new CheckExchangeAuthRequest(
            $auth
        );

        $this->assertSame($auth, $req->getAuth());

        $req = new CheckExchangeAuthRequest(
            new ExchangeAuthSpec($url, $user, $pass, AuthScheme::BASIC(), $type)
        );
        $req->setAuth($auth);
        $this->assertSame($auth, $req->getAuth());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckExchangeAuthRequest>'
                . '<auth url="' . $url . '" user="' . $user . '" pass="' . $pass . '" scheme="' . AuthScheme::FORM() . '" type="' . $type . '" />'
            . '</CheckExchangeAuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckExchangeAuthRequest::class, 'xml'));

        $json = json_encode([
            'auth' => [
                'url' => $url,
                'user' => $user,
                'pass' => $pass,
                'scheme' => (string) AuthScheme::FORM(),
                'type' => $type,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckExchangeAuthRequest::class, 'json'));
    }
}
