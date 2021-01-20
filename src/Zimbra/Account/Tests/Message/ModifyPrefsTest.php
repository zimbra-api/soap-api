<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\ModifyPrefsBody;
use Zimbra\Account\Message\ModifyPrefsEnvelope;
use Zimbra\Account\Message\ModifyPrefsRequest;
use Zimbra\Account\Message\ModifyPrefsResponse;
use Zimbra\Account\Struct\Pref;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ModifyPrefsTest.
 */
class ModifyPrefsTest extends ZimbraStructTestCase
{
    public function testModifyPrefs()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $modified = mt_rand(1, 100);

        $pref = new Pref($name, $value, $modified);

        $request = new ModifyPrefsRequest([$pref]);
        $this->assertSame([$pref], $request->getPrefs());
        $request = new ModifyPrefsRequest();
        $request->setPrefs([$pref])
            ->addPref($pref);
        $this->assertSame([$pref, $pref], $request->getPrefs());
        $request->setPrefs([$pref]);

        $response = new ModifyPrefsResponse();

        $body = new ModifyPrefsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyPrefsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyPrefsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ModifyPrefsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ModifyPrefsRequest>
            <pref name="$name" modified="$modified">$value</pref>
        </urn:ModifyPrefsRequest>
        <urn:ModifyPrefsResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyPrefsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ModifyPrefsRequest' => [
                    'pref' => [
                        [
                            'name' => $name,
                            'modified' => $modified,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'ModifyPrefsResponse' => [
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ModifyPrefsEnvelope::class, 'json'));
    }
}
