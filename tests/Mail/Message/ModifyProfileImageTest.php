<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\ModifyProfileImageEnvelope;
use Zimbra\Mail\Message\ModifyProfileImageBody;
use Zimbra\Mail\Message\ModifyProfileImageRequest;
use Zimbra\Mail\Message\ModifyProfileImageResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyProfileImage.
 */
class ModifyProfileImageTest extends ZimbraTestCase
{
    public function testModifyProfileImage()
    {
        $uploadId = $this->faker->uuid;
        $imageB64Data = $this->faker->text;
        $itemId = $this->faker->randomNumber;

        $request = new ModifyProfileImageRequest(
            $uploadId, $imageB64Data
        );
        $this->assertSame($uploadId, $request->getUploadId());
        $this->assertSame($imageB64Data, $request->getImageB64Data());
        $request = new ModifyProfileImageRequest();
        $request->setUploadId($uploadId)
            ->setImageB64Data($imageB64Data);
        $this->assertSame($uploadId, $request->getUploadId());
        $this->assertSame($imageB64Data, $request->getImageB64Data());

        $response = new ModifyProfileImageResponse($itemId);
        $this->assertSame($itemId, $response->getItemId());
        $response = new ModifyProfileImageResponse();
        $response->setItemId($itemId);
        $this->assertSame($itemId, $response->getItemId());

        $body = new ModifyProfileImageBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyProfileImageBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyProfileImageEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ModifyProfileImageEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ModifyProfileImageRequest uid="$uploadId">$imageB64Data</urn:ModifyProfileImageRequest>
        <urn:ModifyProfileImageResponse itemId="$itemId" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyProfileImageEnvelope::class, 'xml'));
    }
}
