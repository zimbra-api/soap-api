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
        $modified = mt_rand(1, 100);

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
        $response->setPrefs([$pref])
            ->addPref($pref);
        $this->assertSame([$pref, $pref], $response->getPrefs());
        $response->setPrefs([$pref]);

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
            <pref name="$name" modified="$modified">$value</pref>
        </urn:GetPrefsRequest>
        <urn:GetPrefsResponse>
            <pref name="$name" modified="$modified">$value</pref>
        </urn:GetPrefsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetPrefsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetPrefsRequest' => [
                    'pref' => [
                        [
                            'name' => $name,
                            'modified' => $modified,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'GetPrefsResponse' => [
                    'pref' => [
                        [
                            'name' => $name,
                            'modified' => $modified,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetPrefsEnvelope::class, 'json'));
    }
}