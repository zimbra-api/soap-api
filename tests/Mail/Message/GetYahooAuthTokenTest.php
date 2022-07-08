<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GetYahooAuthTokenEnvelope;
use Zimbra\Mail\Message\GetYahooAuthTokenBody;
use Zimbra\Mail\Message\GetYahooAuthTokenRequest;
use Zimbra\Mail\Message\GetYahooAuthTokenResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetYahooAuthToken.
 */
class GetYahooAuthTokenTest extends ZimbraTestCase
{
    public function testGetYahooAuthToken()
    {
        $user = $this->faker->email;
        $password = $this->faker->word;

        $request = new GetYahooAuthTokenRequest($user, $password);
        $this->assertSame($user, $request->getUser());
        $this->assertSame($password, $request->getPassword());
        $request = new GetYahooAuthTokenRequest();
        $request->setUser($user)->setPassword($password);
        $this->assertSame($user, $request->getUser());
        $this->assertSame($password, $request->getPassword());

        $response = new GetYahooAuthTokenResponse(FALSE);
        $this->assertFalse($response->getFailed());
        $response->setFailed(TRUE);
        $this->assertTrue($response->getFailed());

        $body = new GetYahooAuthTokenBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetYahooAuthTokenBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetYahooAuthTokenEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetYahooAuthTokenEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetYahooAuthTokenRequest user="$user" password="$password" />
        <urn:GetYahooAuthTokenResponse failed="true" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetYahooAuthTokenEnvelope::class, 'xml'));
    }
}
