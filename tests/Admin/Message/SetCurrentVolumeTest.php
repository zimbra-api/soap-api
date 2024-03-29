<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\SetCurrentVolumeBody;
use Zimbra\Admin\Message\SetCurrentVolumeEnvelope;
use Zimbra\Admin\Message\SetCurrentVolumeRequest;
use Zimbra\Admin\Message\SetCurrentVolumeResponse;
use Zimbra\Admin\Struct\StoreManagerRuntimeSwitchResult;
use Zimbra\Common\Enum\RuntimeSwitchStatus;
use Zimbra\Common\Enum\VolumeType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SetCurrentVolumeTest.
 */
class SetCurrentVolumeTest extends ZimbraTestCase
{
    public function testSetCurrentVolume()
    {
        $id = $this->faker->randomNumber;
        $type = VolumeType::PRIMARY->value;
        $status = RuntimeSwitchStatus::SUCCESS->value;
        $message = $this->faker->word;

        $request = new SetCurrentVolumeRequest($id, $type);
        $this->assertSame($id, $request->getId());
        $this->assertSame($type, $request->getType());

        $request = new SetCurrentVolumeRequest();
        $request->setId($id)
            ->setType($type);
        $this->assertSame($id, $request->getId());
        $this->assertSame($type, $request->getType());

        $result = new StoreManagerRuntimeSwitchResult(RuntimeSwitchStatus::SUCCESS, $message);
        $response = new SetCurrentVolumeResponse($result);
        $this->assertSame($result, $response->getRuntimeSwitchResult());
        $response = new SetCurrentVolumeResponse();
        $response->setRuntimeSwitchResult($result);
        $this->assertSame($result, $response->getRuntimeSwitchResult());

        $body = new SetCurrentVolumeBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SetCurrentVolumeBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SetCurrentVolumeEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SetCurrentVolumeEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:SetCurrentVolumeRequest id="$id" type="$type" />
        <urn:SetCurrentVolumeResponse>
            <urn:storeManagerRuntimeSwitchResult status="$status" message="$message" />
        </urn:SetCurrentVolumeResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SetCurrentVolumeEnvelope::class, 'xml'));
    }
}
