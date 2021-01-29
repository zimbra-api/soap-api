<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\MailboxBlobConsistency;

use Zimbra\Admin\Struct\BlobSizeInfo;
use Zimbra\Admin\Struct\BlobRevisionInfo;

use Zimbra\Admin\Struct\MissingBlobInfo;
use Zimbra\Admin\Struct\MissingBlobsWrapper;

use Zimbra\Admin\Struct\IncorrectBlobSizeInfo;
use Zimbra\Admin\Struct\IncorrectSizesWrapper;

use Zimbra\Admin\Struct\UnexpectedBlobInfo;
use Zimbra\Admin\Struct\UnexpectedBlobsWrapper;

use Zimbra\Admin\Struct\IncorrectRevisionsWrapper;
use Zimbra\Admin\Struct\IncorrectBlobRevisionInfo;

use Zimbra\Admin\Struct\UsedBlobInfo;
use Zimbra\Admin\Struct\UsedBlobsWrapper;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailboxBlobConsistency.
 */
class MailboxBlobConsistencyTest extends ZimbraTestCase
{
    public function testMailboxBlobConsistency()
    {
        $id = mt_rand(1, 100);
        $revision = mt_rand(1, 100);
        $size = mt_rand(1, 100);
        $volumeId = mt_rand(1, 100);
        $blobPath = $this->faker->word;
        $version = mt_rand(1, 100);
        $path = $this->faker->word;
        $fileSize = mt_rand(1, 100);

        $missingBlob = new MissingBlobInfo(
            $id, $revision, $size, $volumeId, $blobPath, TRUE, $version
        );
        $incorrectSize = new IncorrectBlobSizeInfo(
            $id, $revision, $size, $volumeId, new BlobSizeInfo(
                $path, $size, $fileSize, TRUE
            )
        );
        $unexpectedBlob = new UnexpectedBlobInfo(
            $volumeId, $path, $fileSize, TRUE
        );
        $incorrectRevision = new IncorrectBlobRevisionInfo(
            $id, $revision, $size, $volumeId, new BlobRevisionInfo(
                $path, $fileSize, $revision, TRUE
            )
        );
        $usedBlob = new UsedBlobInfo(
            $id, $revision, $size, $volumeId, new BlobSizeInfo(
                $path, $size, $fileSize, TRUE
            )
        );

        $mbox = new MailboxBlobConsistency(
            $id, [$missingBlob], [$incorrectSize], [$unexpectedBlob], [$incorrectRevision], [$usedBlob]
        );
        $this->assertSame($id, $mbox->getId());
        $this->assertSame([$missingBlob], $mbox->getMissingBlobs());
        $this->assertSame([$incorrectSize], $mbox->getIncorrectSizes());
        $this->assertSame([$unexpectedBlob], $mbox->getUnexpectedBlobs());
        $this->assertSame([$incorrectRevision], $mbox->getIncorrectRevisions());
        $this->assertSame([$usedBlob], $mbox->getUsedBlobs());

        $mbox = new MailboxBlobConsistency(0);
        $mbox->setId($id)
             ->setMissingBlobs([$missingBlob])
             ->addMissingBlob($missingBlob)
             ->setIncorrectSizes([$incorrectSize])
             ->addIncorrectSize($incorrectSize)
             ->setUnexpectedBlobs([$unexpectedBlob])
             ->addUnexpectedBlob($unexpectedBlob)
             ->setIncorrectRevisions([$incorrectRevision])
             ->addIncorrectRevision($incorrectRevision)
             ->setUsedBlobs([$usedBlob])
             ->addUsedBlob($usedBlob);
        $this->assertSame($id, $mbox->getId());
        $this->assertSame([$missingBlob, $missingBlob], $mbox->getMissingBlobs());
        $this->assertSame([$incorrectSize, $incorrectSize], $mbox->getIncorrectSizes());
        $this->assertSame([$unexpectedBlob, $unexpectedBlob], $mbox->getUnexpectedBlobs());
        $this->assertSame([$incorrectRevision, $incorrectRevision], $mbox->getIncorrectRevisions());
        $this->assertSame([$usedBlob, $usedBlob], $mbox->getUsedBlobs());

        $mbox = new MailboxBlobConsistency(
            $id, [$missingBlob], [$incorrectSize], [$unexpectedBlob], [$incorrectRevision], [$usedBlob]
        );
        $xml = <<<EOT
<?xml version="1.0"?>
<mbox id ="$id">
    <missingBlobs>
        <item id="$id" rev="$revision" s="$size" volumeId="$volumeId" blobPath="$blobPath" external="true" version="$version" />
    </missingBlobs>
    <incorrectSizes>
        <item id="$id" rev="$revision" s="$size" volumeId="$volumeId">
            <blob path="$path" s="$size" fileSize="$fileSize" external="true" />
        </item>
    </incorrectSizes>
    <unexpectedBlobs>
        <blob volumeId="$volumeId" path="$path" fileSize="$fileSize" external="true" />
    </unexpectedBlobs>
    <incorrectRevisions>
        <item id="$id" rev="$revision" s="$size" volumeId="$volumeId">
            <blob path="$path" fileSize="$fileSize" rev="$revision" external="true" />
        </item>
    </incorrectRevisions>
    <usedBlobs>
        <item id="$id" rev="$revision" s="$size" volumeId="$volumeId">
            <blob path="$path" s="$size" fileSize="$fileSize" external="true" />
        </item>
    </usedBlobs>
</mbox>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mbox, 'xml'));
        $this->assertEquals($mbox, $this->serializer->deserialize($xml, MailboxBlobConsistency::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'missingBlobs' => [
                'item' => [
                    [
                        'id' => $id,
                        'rev' => $revision,
                        's' => $size,
                        'volumeId' => $volumeId,
                        'blobPath' => $blobPath,
                        'external' => TRUE,
                        'version' => $version,
                    ],
                ]
            ],
            'incorrectSizes' => [
                'item' => [
                    [
                        'id' => $id,
                        'rev' => $revision,
                        's' => $size,
                        'volumeId' => $volumeId,
                        'blob' => [
                            'path' => $path,
                            's' => $size,
                            'fileSize' => $fileSize,
                            'external' => TRUE,
                        ],
                    ],
                ]
            ],
            'unexpectedBlobs' => [
                'blob' => [
                    [
                        'volumeId' => $volumeId,
                        'path' => $path,
                        'fileSize' => $fileSize,
                        'external' => TRUE,
                    ],
                ]
            ],
            'incorrectRevisions' => [
                'item' => [
                    [
                        'id' => $id,
                        'rev' => $revision,
                        's' => $size,
                        'volumeId' => $volumeId,
                        'blob' => [
                            'path' => $path,
                            'fileSize' => $fileSize,
                            'rev' => $revision,
                            'external' => TRUE,
                        ],
                    ],
                ]
            ],
            'usedBlobs' => [
                'item' => [
                    [
                        'id' => $id,
                        'rev' => $revision,
                        's' => $size,
                        'volumeId' => $volumeId,
                        'blob' => [
                            'path' => $path,
                            's' => $size,
                            'fileSize' => $fileSize,
                            'external' => TRUE,
                        ],
                    ],
                ]
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($mbox, 'json'));
        $this->assertEquals($mbox, $this->serializer->deserialize($json, MailboxBlobConsistency::class, 'json'));
    }
}
