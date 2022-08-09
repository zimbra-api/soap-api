<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\GetPrefsBody;
use Zimbra\Account\Message\GetPrefsEnvelope;
use Zimbra\Account\Message\GetPrefsRequest;
use Zimbra\Account\Message\GetPrefsResponse;
use Zimbra\Account\Struct\Pref;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetPrefsTest.
 */
class GetPrefsTest extends ZimbraTestCase
{
    public function testGetPrefs()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $modified = $this->faker->randomNumber;

        $pref = new Pref($name, $value, $modified);

        $request = new GetPrefsRequest([$pref]);
        $this->assertSame([$pref], $request->getPrefs());
        $request = new GetPrefsRequest();
        $request->setPrefs([$pref])
            ->addPref($pref);
        $this->assertSame([$pref, $pref], $request->getPrefs());
        $request->setPrefs([$pref]);

        $response = new GetPrefsResponse([$pref]);
        $this->assertSame([$pref], $response->getPrefs());
        $response = new GetPrefsResponse();
        $response->setPrefs([$pref]);
        $this->assertSame([$pref], $response->getPrefs());

        $body = new GetPrefsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetPrefsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetPrefsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetPrefsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetPrefsRequest>
            <urn:pref name="$name" modified="$modified">$value</urn:pref>
        </urn:GetPrefsRequest>
        <urn:GetPrefsResponse>
            <urn:pref name="$name" modified="$modified">$value</urn:pref>
        </urn:GetPrefsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetPrefsEnvelope::class, 'xml'));
    }
}
