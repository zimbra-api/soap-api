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
        $newName = $this->faker->word;

        $calResource = new CalendarResourceInfo($name, $id, [new Attr($key, $value)]);

        $request = new RenameCalendarResourceRequest(
            $id, $newName
        );
        $this->assertSame($id, $request->getId());
        $this->assertSame($newName, $request->getNewName());
        $request = new RenameCalendarResourceRequest('', '');
        $request->setId($id)
            ->setNewName($newName);
        $this->assertSame($id, $request->getId());
        $this->assertSame($newName, $request->getNewName());

        $response = new RenameCalendarResourceResponse($calResource);
        $this->assertEquals($calResource, $response->getCalResource());
        $response = new RenameCalendarResourceResponse(new CalendarResourceInfo('', ''));
        $response->setCalResource($calResource);
        $this->assertEquals($calResource, $response->getCalResource());

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
        <urn:RenameCalendarResourceRequest id="$id" newName="$newName" />
        <urn:RenameCalendarResourceResponse>
            <calresource name="$name" id="$id">
                <a n="$key">$value</a>
            </calresource>
        </urn:RenameCalendarResourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RenameCalendarResourceEnvelope::class, 'xml'));
    }
}
