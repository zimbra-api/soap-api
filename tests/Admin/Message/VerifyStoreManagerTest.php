<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Response;

use Zimbra\Admin\Message\VerifyStoreManagerBody;
use Zimbra\Admin\Message\VerifyStoreManagerEnvelope;
use Zimbra\Admin\Message\VerifyStoreManagerRequest;
use Zimbra\Admin\Message\VerifyStoreManagerResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for VerifyStoreManager.
 */
class VerifyStoreManagerTest extends ZimbraTestCase
{
    public function testVerifyStoreManager()
    {
        $fileSize = $this->faker->randomNumber;
        $num = $this->faker->randomNumber;
        $storeManagerClass = $this->faker->word;
        $incomingTime = $this->faker->unixTime;
        $stageTime = $this->faker->unixTime;
        $linkTime = $this->faker->unixTime;
        $fetchTime = $this->faker->unixTime;
        $deleteTime = $this->faker->unixTime;

        $request = new VerifyStoreManagerRequest(
            $fileSize, $num, FALSE
        );
        $this->assertSame($fileSize, $request->getFileSize());
        $this->assertSame($num, $request->getNum());
        $this->assertFalse($request->getCheckBlobs());

        $request = new VerifyStoreManagerRequest();
        $request->setFileSize($fileSize)
            ->setNum($num)
            ->setCheckBlobs(TRUE);
        $this->assertSame($fileSize, $request->getFileSize());
        $this->assertSame($num, $request->getNum());
        $this->assertTrue($request->getCheckBlobs());

        $response = new VerifyStoreManagerResponse(
            $storeManagerClass, $incomingTime, $stageTime, $linkTime, $fetchTime, $deleteTime
        );
        $this->assertSame($storeManagerClass, $response->getStoreManagerClass());
        $this->assertSame($incomingTime, $response->getIncomingTime());
        $this->assertSame($stageTime, $response->getStageTime());
        $this->assertSame($linkTime, $response->getLinkTime());
        $this->assertSame($fetchTime, $response->getFetchTime());
        $this->assertSame($deleteTime, $response->getDeleteTime());

        $response = new VerifyStoreManagerResponse();
        $response->setStoreManagerClass($storeManagerClass)
            ->setIncomingTime($incomingTime)
            ->setStageTime($stageTime)
            ->setLinkTime($linkTime)
            ->setFetchTime($fetchTime)
            ->setDeleteTime($deleteTime);
        $this->assertSame($storeManagerClass, $response->getStoreManagerClass());
        $this->assertSame($incomingTime, $response->getIncomingTime());
        $this->assertSame($stageTime, $response->getStageTime());
        $this->assertSame($linkTime, $response->getLinkTime());
        $this->assertSame($fetchTime, $response->getFetchTime());
        $this->assertSame($deleteTime, $response->getDeleteTime());

        $body = new VerifyStoreManagerBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new VerifyStoreManagerBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new VerifyStoreManagerEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new VerifyStoreManagerEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:VerifyStoreManagerRequest fileSize="$fileSize" num="$num" checkBlobs="true" />
        <urn:VerifyStoreManagerResponse storeManagerClass="$storeManagerClass" incomingTime="$incomingTime" stageTime="$stageTime" linkTime="$linkTime" fetchTime="$fetchTime" deleteTime="$deleteTime" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, VerifyStoreManagerEnvelope::class, 'xml'));
    }
}
