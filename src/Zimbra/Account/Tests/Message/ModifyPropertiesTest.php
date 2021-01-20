<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\ModifyPropertiesBody;
use Zimbra\Account\Message\ModifyPropertiesEnvelope;
use Zimbra\Account\Message\ModifyPropertiesRequest;
use Zimbra\Account\Message\ModifyPropertiesResponse;
use Zimbra\Account\Struct\Prop;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ModifyPropertiesTest.
 */
class ModifyPropertiesTest extends ZimbraStructTestCase
{
    public function testModifyProperties()
    {
        $zimlet = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;

        $prop = new Prop($zimlet, $name, $value);
 
        $request = new ModifyPropertiesRequest([$prop]);
        $this->assertSame([$prop], $request->getProps());
        $request = new ModifyPropertiesRequest();
        $request->setProps([$prop])
            ->addProp($prop);
        $this->assertSame([$prop, $prop], $request->getProps());
        $request->setProps([$prop]);

        $response = new ModifyPropertiesResponse();

        $body = new ModifyPropertiesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyPropertiesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyPropertiesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ModifyPropertiesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ModifyPropertiesRequest>
            <prop zimlet="$zimlet" name="$name">$value</prop>
        </urn:ModifyPropertiesRequest>
        <urn:ModifyPropertiesResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyPropertiesEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ModifyPropertiesRequest' => [
                    'prop' => [
                        [
                            'zimlet' => $zimlet,
                            'name' => $name,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'ModifyPropertiesResponse' => [
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ModifyPropertiesEnvelope::class, 'json'));
    }
}
