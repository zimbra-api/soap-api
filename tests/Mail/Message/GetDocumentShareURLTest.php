<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GetDocumentShareURLEnvelope;
use Zimbra\Mail\Message\GetDocumentShareURLBody;
use Zimbra\Mail\Message\GetDocumentShareURLRequest;
use Zimbra\Mail\Message\GetDocumentShareURLResponse;

use Zimbra\Mail\Struct\ItemSpec;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetDocumentShareURL.
 */
class GetDocumentShareURLTest extends ZimbraTestCase
{
    public function testGetDocumentShareURL()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $folderId = $this->faker->uuid;
        $name = $this->faker->name;
        $path = $this->faker->word;
        $url = $this->faker->url;

        $item = new ItemSpec($id, $folderId, $name, $path);
        $request = new GetDocumentShareURLRequest($item);
        $this->assertSame($item, $request->getItem());
        $request = new GetDocumentShareURLRequest(new ItemSpec());
        $request->setItem($item);
        $this->assertSame($item, $request->getItem());

        $response = new GetDocumentShareURLResponse($url);
        $this->assertSame($url, $response->getUrl());
        $response = new GetDocumentShareURLResponse();
        $response->setUrl($url);
        $this->assertSame($url, $response->getUrl());

        $body = new GetDocumentShareURLBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetDocumentShareURLBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetDocumentShareURLEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetDocumentShareURLEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetDocumentShareURLRequest>
            <urn:item id="$id" l="$folderId" name="$name" path="$path" />
        </urn:GetDocumentShareURLRequest>
        <urn:GetDocumentShareURLResponse>$url</urn:GetDocumentShareURLResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetDocumentShareURLEnvelope::class, 'xml'));
    }
}
