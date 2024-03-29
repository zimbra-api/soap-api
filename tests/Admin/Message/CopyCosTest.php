<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CopyCosBody;
use Zimbra\Admin\Message\CopyCosEnvelope;
use Zimbra\Admin\Message\CopyCosRequest;
use Zimbra\Admin\Message\CopyCosResponse;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Common\Enum\CosBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CopyCos.
 */
class CopyCosTest extends ZimbraTestCase
{
    public function testCopyCos()
    {
        $newName = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $cos = new CosSelector(CosBy::NAME, $value);
        $request = new CopyCosRequest($cos, $newName);
        $this->assertSame($cos, $request->getCos());
        $this->assertSame($newName, $request->getNewName());
        $request = new CopyCosRequest();
        $request->setCos($cos)
            ->setNewName($newName);
        $this->assertSame($cos, $request->getCos());
        $this->assertSame($newName, $request->getNewName());

        $cosInfo = new CosInfo($name, $id, TRUE, [new CosInfoAttr($key, $value, TRUE, FALSE)]);
        $response = new CopyCosResponse($cosInfo);
        $this->assertSame($cosInfo, $response->getCos());
        $response = new CopyCosResponse();
        $response->setCos($cosInfo);
        $this->assertSame($cosInfo, $response->getCos());

        $body = new CopyCosBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CopyCosBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CopyCosEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CopyCosEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CopyCosRequest>
            <urn:name>$newName</urn:name>
            <urn:cos by="name">$value</urn:cos>
        </urn:CopyCosRequest>
        <urn:CopyCosResponse>
            <urn:cos name="$name" id="$id" isDefaultCos="true">
                <urn:a n="$key" c="true" pd="false">$value</urn:a>
            </urn:cos>
        </urn:CopyCosResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CopyCosEnvelope::class, 'xml'));
    }
}
