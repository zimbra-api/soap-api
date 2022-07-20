<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CreateCalendarResourceBody;
use Zimbra\Admin\Message\CreateCalendarResourceEnvelope;
use Zimbra\Admin\Message\CreateCalendarResourceRequest;
use Zimbra\Admin\Message\CreateCalendarResourceResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateCalendarResource.
 */
class CreateCalendarResourceTest extends ZimbraTestCase
{
    public function testCreateCalendarResource()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $password = $this->faker->word;
        $id = $this->faker->uuid;

        $attr = new Attr($key, $value);
        $calResource = new CalendarResourceInfo($name, $id, [$attr]);

        $request = new CreateCalendarResourceRequest(
            $name, $password, [$attr]
        );
        $this->assertSame($name, $request->getName());
        $this->assertSame($password, $request->getPassword());
        $request = new CreateCalendarResourceRequest();
        $request->setName($name)
            ->setPassword($password)
            ->setAttrs([$attr]);
        $this->assertSame($name, $request->getName());
        $this->assertSame($password, $request->getPassword());

        $response = new CreateCalendarResourceResponse($calResource);
        $this->assertSame($calResource, $response->getCalResource());
        $response = new CreateCalendarResourceResponse();
        $response->setCalResource($calResource);
        $this->assertSame($calResource, $response->getCalResource());

        $body = new CreateCalendarResourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateCalendarResourceBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateCalendarResourceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateCalendarResourceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateCalendarResourceRequest name="$name" password="$password">
            <urn:a n="$key">$value</urn:a>
        </urn:CreateCalendarResourceRequest>
        <urn:CreateCalendarResourceResponse>
            <urn:calresource name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:calresource>
        </urn:CreateCalendarResourceResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateCalendarResourceEnvelope::class, 'xml'));
    }
}
