<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Request;

use Zimbra\Admin\Message\CheckBlobConsistencyBody;
use Zimbra\Admin\Message\CheckBlobConsistencyEnvelope;
use Zimbra\Admin\Message\CheckBlobConsistencyRequest;
use Zimbra\Admin\Message\CheckBlobConsistencyResponse;
use Zimbra\Admin\Struct\IntIdAttr;
use Zimbra\Admin\Struct\MailboxBlobConsistency;
use Zimbra\Admin\Struct\BlobSizeInfo;
use Zimbra\Admin\Struct\BlobRevisionInfo;
use Zimbra\Admin\Struct\MissingBlobInfo;
use Zimbra\Admin\Struct\IncorrectBlobSizeInfo;
use Zimbra\Admin\Struct\UnexpectedBlobInfo;
use Zimbra\Admin\Struct\IncorrectBlobRevisionInfo;
use Zimbra\Admin\Struct\UsedBlobInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckBlobConsistency.
 */
class CheckBlobConsistencyTest extends ZimbraTestCase
{
    public function testCheckBlobConsistency()
    {
        $id = $this->faker->randomNumber;
        $revision = $this->faker->randomNumber;
        $size = $this->faker->randomNumber;
        $volumeId = $this->faker->randomNumber;
        $blobPath = $this->faker->word;
        $version = $this->faker->randomNumber;
        $path = $this->faker->word;
        $fileSize = $this->faker->randomNumber;

        $volume = new IntIdAttr($volumeId);
        $mbox = new IntIdAttr($id);
        $request = new CheckBlobConsistencyRequest(
            FALSE, FALSE, [$volume], [$mbox]
        );
        $this->assertFalse($request->getCheckSize());
        $this->assertFalse($request->getReportUsedBlobs());
        $this->assertSame([$volume], $request->getVolumes());
        $this->assertSame([$mbox], $request->getMailboxes());
        $request = new CheckBlobConsistencyRequest();
        $request->setCheckSize(TRUE)
            ->setReportUsedBlobs(TRUE)
            ->setVolumes([$volume])
            ->addVolume($volume)
            ->setMailboxes([$mbox])
            ->addMailbox($mbox);
        $this->assertTrue($request->getCheckSize());
        $this->assertTrue($request->getReportUsedBlobs());
        $this->assertSame([$volume, $volume], $request->getVolumes());
        $this->assertSame([$mbox, $mbox], $request->getMailboxes());
        $request->setVolumes([$volume])
            ->setMailboxes([$mbox]);

        $missingBlobs = [
            new MissingBlobInfo(
                $id, $revision, $size, $volumeId, $blobPath, TRUE, $version
            )
        ];
        $incorrectSizes = [
            new IncorrectBlobSizeInfo(
                $id, $revision, $size, $volumeId, new BlobSizeInfo(
                    $path, $size, $fileSize, TRUE
                )
            )
        ];
        $unexpectedBlobs = [
            new UnexpectedBlobInfo(
                $volumeId, $path, $fileSize, TRUE
            )
        ];
        $incorrectRevisions = [
            new IncorrectBlobRevisionInfo(
                $id, $revision, $size, $volumeId, new BlobRevisionInfo(
                    $path, $fileSize, $revision, TRUE
                )
            )
        ];
        $usedBlobs = [
            new UsedBlobInfo(
                $id, $revision, $size, $volumeId, new BlobSizeInfo(
                    $path, $size, $fileSize, TRUE
                )
            )
        ];
        $mbox = new MailboxBlobConsistency(
            $id, $missingBlobs, $incorrectSizes, $unexpectedBlobs, $incorrectRevisions, $usedBlobs
        );
        $response = new CheckBlobConsistencyResponse([$mbox]);
        $this->assertSame([$mbox], $response->getMailboxes());
        $response = new CheckBlobConsistencyResponse();
        $response->setMailboxes([$mbox])
            ->addMailbox($mbox);
        $this->assertSame([$mbox, $mbox], $response->getMailboxes());
        $response->setMailboxes([$mbox]);

        $body = new CheckBlobConsistencyBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckBlobConsistencyBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CheckBlobConsistencyEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckBlobConsistencyEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckBlobConsistencyRequest checkSize="true" reportUsedBlobs="true">
            <urn:volume id="$volumeId" />
            <urn:mbox id="$id" />
        </urn:CheckBlobConsistencyRequest>
        <urn:CheckBlobConsistencyResponse>
            <urn:mbox id ="$id">
                <urn:missingBlobs>
                    <urn:item id="$id" rev="$revision" s="$size" volumeId="$volumeId" blobPath="$blobPath" external="true" version="$version" />
                </urn:missingBlobs>
                <urn:incorrectSizes>
                    <urn:item id="$id" rev="$revision" s="$size" volumeId="$volumeId">
                        <urn:blob path="$path" s="$size" fileSize="$fileSize" external="true" />
                    </urn:item>
                </urn:incorrectSizes>
                <urn:unexpectedBlobs>
                    <urn:blob volumeId="$volumeId" path="$path" fileSize="$fileSize" external="true" />
                </urn:unexpectedBlobs>
                <urn:incorrectRevisions>
                    <urn:item id="$id" rev="$revision" s="$size" volumeId="$volumeId">
                        <urn:blob path="$path" fileSize="$fileSize" rev="$revision" external="true" />
                    </urn:item>
                </urn:incorrectRevisions>
                <urn:usedBlobs>
                    <urn:item id="$id" rev="$revision" s="$size" volumeId="$volumeId">
                        <urn:blob path="$path" s="$size" fileSize="$fileSize" external="true" />
                    </urn:item>
                </urn:usedBlobs>
            </urn:mbox>
        </urn:CheckBlobConsistencyResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckBlobConsistencyEnvelope::class, 'xml'));
    }
}
