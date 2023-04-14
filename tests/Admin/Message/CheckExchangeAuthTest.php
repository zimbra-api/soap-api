<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CheckExchangeAuthBody;
use Zimbra\Admin\Message\CheckExchangeAuthEnvelope;
use Zimbra\Admin\Message\CheckExchangeAuthRequest;
use Zimbra\Admin\Message\CheckExchangeAuthResponse;
use Zimbra\Admin\Struct\ExchangeAuthSpec;
use Zimbra\Common\Enum\AuthScheme;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckExchangeAuth.
 */
class CheckExchangeAuthTest extends ZimbraTestCase
{
    public function testCheckExchangeAuth()
    {
        $url = $this->faker->word;
        $user = $this->faker->word;
        $pass = $this->faker->word;
        $type = $this->faker->word;
        $code = $this->faker->word;
        $message = $this->faker->word;

        $auth = new ExchangeAuthSpec($url, $user, $pass, AuthScheme::FORM, $type);
        $request = new CheckExchangeAuthRequest($auth);
        $this->assertSame($auth, $request->getAuth());
        $request = new CheckExchangeAuthRequest(
            new ExchangeAuthSpec('', '', '', AuthScheme::BASIC, '')
        );
        $request->setAuth($auth);
        $this->assertSame($auth, $request->getAuth());

        $response = new CheckExchangeAuthResponse(
            $code,
            $message
        );
        $this->assertSame($code, $response->getCode());
        $this->assertSame($message, $response->getMessage());

        $response = new CheckExchangeAuthResponse('', '');
        $response->setCode($code)
            ->setMessage($message);
        $this->assertSame($code, $response->getCode());
        $this->assertSame($message, $response->getMessage());

        $body = new CheckExchangeAuthBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckExchangeAuthBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CheckExchangeAuthEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckExchangeAuthEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckExchangeAuthRequest>
            <urn:auth url="$url" user="$user" pass="$pass" scheme="form" type="$type" />
        </urn:CheckExchangeAuthRequest>
        <urn:CheckExchangeAuthResponse>
            <urn:code>$code</urn:code>
            <urn:message>$message</urn:message>
        </urn:CheckExchangeAuthResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckExchangeAuthEnvelope::class, 'xml'));
    }
}
