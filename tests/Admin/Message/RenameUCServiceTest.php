<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\RenameUCServiceBody;
use Zimbra\Admin\Message\RenameUCServiceEnvelope;
use Zimbra\Admin\Message\RenameUCServiceRequest;
use Zimbra\Admin\Message\RenameUCServiceResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\UCServiceInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RenameUCService.
 */
class RenameUCServiceTest extends ZimbraTestCase
{
    public function testRenameUCService()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $request = new RenameUCServiceRequest(
            $id, $name
        );
        $this->assertSame($id, $request->getId());
        $this->assertSame($name, $request->getNewName());
        $request = new RenameUCServiceRequest();
        $request->setId($id)
            ->setNewName($name);
        $this->assertSame($id, $request->getId());
        $this->assertSame($name, $request->getNewName());

        $ucService = new UCServiceInfo($name, $id, [new Attr($key, $value)]);
        $response = new RenameUCServiceResponse($ucService);
        $this->assertSame($ucService, $response->getUCService());
        $response = new RenameUCServiceResponse();
        $response->setUCService($ucService);
        $this->assertSame($ucService, $response->getUCService());

        $body = new RenameUCServiceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new RenameUCServiceBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RenameUCServiceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new RenameUCServiceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RenameUCServiceRequest>
            <urn:id>$id</urn:id>
            <urn:newName>$name</urn:newName>
        </urn:RenameUCServiceRequest>
        <urn:RenameUCServiceResponse>
            <urn:ucservice name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:ucservice>
        </urn:RenameUCServiceResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RenameUCServiceEnvelope::class, 'xml'));
    }
}
