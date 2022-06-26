<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DedupeBlobsBody;
use Zimbra\Admin\Message\DedupeBlobsEnvelope;
use Zimbra\Admin\Message\DedupeBlobsRequest;
use Zimbra\Admin\Message\DedupeBlobsResponse;
use Zimbra\Admin\Struct\IntIdAttr;
use Zimbra\Admin\Struct\VolumeIdAndProgress;
use Zimbra\Common\Enum\DedupAction;
use Zimbra\Common\Enum\DedupStatus;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DedupeBlobs.
 */
class DedupeBlobsTest extends ZimbraTestCase
{
    public function testDedupeBlobs()
    {
        $id = mt_rand(0, 100);
        $totalSize = mt_rand(0, 100);
        $totalCount = mt_rand(0, 100);
        $volumeId = $this->faker->word;
        $progress = $this->faker->word;

        $idAttr = new IntIdAttr($id);
        $blobsProgress = new VolumeIdAndProgress($volumeId, $progress);
        $digestsProgress = new VolumeIdAndProgress($volumeId, $progress);

        $request = new DedupeBlobsRequest(DedupAction::START(), [$idAttr]);
        $this->assertEquals(DedupAction::START(), $request->getAction());
        $this->assertSame([$idAttr], $request->getVolumes());
        $request = new DedupeBlobsRequest(DedupAction::START());
        $request->setAction(DedupAction::STATUS())
            ->setVolumes([$idAttr])
            ->addVolume($idAttr);
        $this->assertEquals(DedupAction::STATUS(), $request->getAction());
        $this->assertSame([$idAttr, $idAttr], $request->getVolumes());
        $request->setVolumes([$idAttr]);

        $response = new DedupeBlobsResponse(DedupStatus::RUNNING(), $totalSize, $totalCount, [$blobsProgress], [$digestsProgress]);
        $this->assertEquals(DedupStatus::RUNNING(), $response->getStatus());
        $this->assertSame($totalSize, $response->getTotalSize());
        $this->assertSame($totalCount, $response->getTotalCount());
        $this->assertSame([$blobsProgress], $response->getVolumeBlobsProgress());
        $this->assertSame([$digestsProgress], $response->getBlobDigestsProgress());
        $response = new DedupeBlobsResponse(DedupStatus::RUNNING(), 0, 0);
        $response->setStatus(DedupStatus::STOPPED())
            ->setTotalSize($totalSize)
            ->setTotalCount($totalCount)
            ->setVolumeBlobsProgress([$blobsProgress])
            ->addVolumeBlobsProgress($blobsProgress)
            ->setBlobDigestsProgress([$digestsProgress])
            ->addBlobDigestsProgress($digestsProgress);
        $this->assertEquals(DedupStatus::STOPPED(), $response->getStatus());
        $this->assertSame($totalSize, $response->getTotalSize());
        $this->assertSame($totalCount, $response->getTotalCount());
        $this->assertSame([$blobsProgress, $blobsProgress], $response->getVolumeBlobsProgress());
        $this->assertSame([$digestsProgress, $digestsProgress], $response->getBlobDigestsProgress());
        $response->setVolumeBlobsProgress([$blobsProgress])
            ->setBlobDigestsProgress([$digestsProgress]);

        $body = new DedupeBlobsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DedupeBlobsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DedupeBlobsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DedupeBlobsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DedupeBlobsRequest action="status">
            <urn:volume id="$id" />
        </urn:DedupeBlobsRequest>
        <urn:DedupeBlobsResponse status="stopped" totalSize="$totalSize" totalCount="$totalCount">
            <urn:volumeBlobsProgress volumeId="$volumeId" progress="$progress" />
            <urn:blobDigestsProgress volumeId="$volumeId" progress="$progress" />
        </urn:DedupeBlobsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DedupeBlobsEnvelope::class, 'xml'));
    }
}
