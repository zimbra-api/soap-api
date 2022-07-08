<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GetYahooCookieEnvelope;
use Zimbra\Mail\Message\GetYahooCookieBody;
use Zimbra\Mail\Message\GetYahooCookieRequest;
use Zimbra\Mail\Message\GetYahooCookieResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetYahooCookie.
 */
class GetYahooCookieTest extends ZimbraTestCase
{
    public function testGetYahooCookie()
    {
        $user = $this->faker->email;
        $error = $this->faker->word;
        $crumb = $this->faker->word;
        $y = $this->faker->word;
        $t = $this->faker->word;

        $request = new GetYahooCookieRequest($user);
        $this->assertSame($user, $request->getUser());
        $request = new GetYahooCookieRequest();
        $request->setUser($user);
        $this->assertSame($user, $request->getUser());

        $response = new GetYahooCookieResponse($error, $crumb, $y, $t);
        $this->assertSame($error, $response->getError());
        $this->assertSame($crumb, $response->getCrumb());
        $this->assertSame($y, $response->getY());
        $this->assertSame($t, $response->getT());
        $response = new GetYahooCookieResponse();
        $response->setError($error)
            ->setCrumb($crumb)
            ->setY($y)
            ->setT($t);
        $this->assertSame($error, $response->getError());
        $this->assertSame($crumb, $response->getCrumb());
        $this->assertSame($y, $response->getY());
        $this->assertSame($t, $response->getT());

        $body = new GetYahooCookieBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetYahooCookieBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetYahooCookieEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetYahooCookieEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetYahooCookieRequest user="$user" />
        <urn:GetYahooCookieResponse error="$error" crumb="$crumb" y="$y" t="$t" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetYahooCookieEnvelope::class, 'xml'));
    }
}
