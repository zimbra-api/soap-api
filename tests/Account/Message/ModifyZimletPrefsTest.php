<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\ModifyZimletPrefsBody;
use Zimbra\Account\Message\ModifyZimletPrefsEnvelope;
use Zimbra\Account\Message\ModifyZimletPrefsRequest;
use Zimbra\Account\Message\ModifyZimletPrefsResponse;
use Zimbra\Account\Struct\ModifyZimletPrefsSpec;
use Zimbra\Enum\ZimletStatus;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for ModifyZimletPrefsTest.
 */
class ModifyZimletPrefsTest extends ZimbraStructTestCase
{
    public function testModifyZimletPrefs()
    {
        $name = $this->faker->name;

        $zimlet = new ModifyZimletPrefsSpec($name, ZimletStatus::ENABLED());

        $request = new ModifyZimletPrefsRequest([$zimlet]);
        $this->assertSame([$zimlet], $request->getZimlets());
        $request = new ModifyZimletPrefsRequest();
        $request->setZimlets([$zimlet])
            ->addZimlet($zimlet);
        $this->assertSame([$zimlet, $zimlet], $request->getZimlets());
        $request->setZimlets([$zimlet]);

        $response = new ModifyZimletPrefsResponse([$name]);
        $this->assertSame([$name], $response->getZimlets());
        $response = new ModifyZimletPrefsResponse();
        $response->setZimlets([$name])
            ->addZimlet($name);
        $this->assertSame([$name], $response->getZimlets());

        $body = new ModifyZimletPrefsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyZimletPrefsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyZimletPrefsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ModifyZimletPrefsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ModifyZimletPrefsRequest>
            <zimlet name="$name" presence="enabled" />
        </urn:ModifyZimletPrefsRequest>
        <urn:ModifyZimletPrefsResponse>
            <zimlet>$name</zimlet>
        </urn:ModifyZimletPrefsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyZimletPrefsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ModifyZimletPrefsRequest' => [
                    'zimlet' => [
                        [
                            'name' => $name,
                            'presence' => 'enabled',
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'ModifyZimletPrefsResponse' => [
                    'zimlet' => [
                        [
                            '_content' => $name,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ModifyZimletPrefsEnvelope::class, 'json'));
    }
}
