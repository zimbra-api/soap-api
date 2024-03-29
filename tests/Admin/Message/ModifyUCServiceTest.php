<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ModifyUCServiceBody;
use Zimbra\Admin\Message\ModifyUCServiceEnvelope;
use Zimbra\Admin\Message\ModifyUCServiceRequest;
use Zimbra\Admin\Message\ModifyUCServiceResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\UCServiceInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyUCService.
 */
class ModifyUCServiceTest extends ZimbraTestCase
{
    public function testModifyUCService()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $request = new ModifyUCServiceRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new ModifyUCServiceRequest();
        $request->setId($id)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($id, $request->getId());

        $ucservice = new UCServiceInfo($name, $id, [new Attr($key, $value)]);
        $response = new ModifyUCServiceResponse($ucservice);
        $this->assertSame($ucservice, $response->getUCService());
        $response = new ModifyUCServiceResponse();
        $response->setUCService($ucservice);
        $this->assertSame($ucservice, $response->getUCService());

        $body = new ModifyUCServiceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyUCServiceBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyUCServiceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifyUCServiceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyUCServiceRequest>
            <urn:id>$id</urn:id>
            <urn:a n="$key">$value</urn:a>
        </urn:ModifyUCServiceRequest>
        <urn:ModifyUCServiceResponse>
            <urn:ucservice name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:ucservice>
        </urn:ModifyUCServiceResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyUCServiceEnvelope::class, 'xml'));
    }
}
