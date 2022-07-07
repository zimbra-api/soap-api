<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\MailItemType;

use Zimbra\Mail\Message\IMAPCopyEnvelope;
use Zimbra\Mail\Message\IMAPCopyBody;
use Zimbra\Mail\Message\IMAPCopyRequest;
use Zimbra\Mail\Message\IMAPCopyResponse;

use Zimbra\Mail\Struct\IMAPItemInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for IMAPCopy.
 */
class IMAPCopyTest extends ZimbraTestCase
{
    public function testIMAPCopy()
    {
        $ids = $this->faker->word;
        $type = MailItemType::MESSAGE();
        $folder = $this->faker->randomNumber;
        $id = $this->faker->randomNumber;
        $imapUid = $this->faker->randomNumber;

        $item = new IMAPItemInfo($id, $imapUid);

        $request = new IMAPCopyRequest($ids, $type, $folder);
        $this->assertSame($ids, $request->getIds());
        $this->assertSame($type, $request->getType());
        $this->assertSame($folder, $request->getFolder());
        $request = new IMAPCopyRequest();
        $request->setIds($ids)
           ->setType($type)
           ->setFolder($folder);
        $this->assertSame($ids, $request->getIds());
        $this->assertSame($type, $request->getType());
        $this->assertSame($folder, $request->getFolder());

        $response = new IMAPCopyResponse([$item]);
        $this->assertSame([$item], $response->getItems());
        $response = new IMAPCopyResponse();
        $response->setItems([$item])
            ->addItem($item);
        $this->assertSame([$item, $item], $response->getItems());
        $response = new IMAPCopyResponse([$item]);

        $body = new IMAPCopyBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new IMAPCopyBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new IMAPCopyEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new IMAPCopyEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:IMAPCopyRequest ids="$ids" t="MESSAGE" l="$folder" />
        <urn:IMAPCopyResponse>
            <urn:item id="$id" i4uid="$imapUid" />
        </urn:IMAPCopyResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, IMAPCopyEnvelope::class, 'xml'));
    }
}
