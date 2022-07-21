<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\RenameCalendarResourceBody;
use Zimbra\Admin\Message\RenameCalendarResourceEnvelope;
use Zimbra\Admin\Message\RenameCalendarResourceRequest;
use Zimbra\Admin\Message\RenameCalendarResourceResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RenameCalendarResource.
 */
class RenameCalendarResourceTest extends ZimbraTestCase
{
    public function testRenameCalendarResource()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $request = new RenameCalendarResourceRequest(
            $id, $name
        );
        $this->assertSame($id, $request->getId());
        $this->assertSame($name, $request->getNewName());
        $request = new RenameCalendarResourceRequest();
        $request->setId($id)
            ->setNewName($name);
        $this->assertSame($id, $request->getId());
        $this->assertSame($name, $request->getNewName());

        $calResource = new CalendarResourceInfo($name, $id, [new Attr($key, $value)]);
        $response = new RenameCalendarResourceResponse($calResource);
        $this->assertSame($calResource, $response->getCalResource());
        $response = new RenameCalendarResourceResponse();
        $response->setCalResource($calResource);
        $this->assertSame($calResource, $response->getCalResource());

        $body = new RenameCalendarResourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new RenameCalendarResourceBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RenameCalendarResourceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new RenameCalendarResourceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RenameCalendarResourceRequest id="$id" newName="$name" />
        <urn:RenameCalendarResourceResponse>
            <urn:calresource name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:calresource>
        </urn:RenameCalendarResourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RenameCalendarResourceEnvelope::class, 'xml'));
    }
}
