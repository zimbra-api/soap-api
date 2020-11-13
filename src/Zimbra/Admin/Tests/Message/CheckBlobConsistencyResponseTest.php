<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\CheckBlobConsistencyResponse;
use Zimbra\Admin\Struct\MailboxBlobConsistency;
use Zimbra\Admin\Struct\BlobSizeInfo;
use Zimbra\Admin\Struct\BlobRevisionInfo;
use Zimbra\Admin\Struct\MissingBlobInfo;
use Zimbra\Admin\Struct\IncorrectBlobSizeInfo;
use Zimbra\Admin\Struct\UnexpectedBlobInfo;
use Zimbra\Admin\Struct\IncorrectBlobRevisionInfo;
use Zimbra\Admin\Struct\UsedBlobInfo;

use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckBlobConsistencyResponse.
 */
class CheckBlobConsistencyResponseTest extends ZimbraStructTestCase
{
    public function testCheckBlobConsistencyResponse()
    {
        $id = mt_rand(1, 100);
        $revision = mt_rand(1, 100);
        $size = mt_rand(1, 100);
        $volumeId = mt_rand(1, 100);
        $blobPath = $this->faker->word;
        $version = mt_rand(1, 100);
        $path = $this->faker->word;
        $fileSize = mt_rand(1, 100);

        $missingBlobs = [new MissingBlobInfo(
            $id, $revision, $size, $volumeId, $blobPath, TRUE, $version
        )];
        $incorrectSizes = [new IncorrectBlobSizeInfo(
            $id, $revision, $size, $volumeId, new BlobSizeInfo(
                $path, $size, $fileSize, TRUE
            )
        )];
        $unexpectedBlobs = [new UnexpectedBlobInfo(
            $volumeId, $path, $fileSize, TRUE
        )];
        $incorrectRevisions = [new IncorrectBlobRevisionInfo(
            $id, $revision, $size, $volumeId, new BlobRevisionInfo(
                $path, $fileSize, $revision, TRUE
            )
        )];
        $usedBlobs = [new UsedBlobInfo(
            $id, $revision, $size, $volumeId, new BlobSizeInfo(
                $path, $size, $fileSize, TRUE
            )
        )];

        $mbox = new MailboxBlobConsistency(
            $id, $missingBlobs, $incorrectSizes, $unexpectedBlobs, $incorrectRevisions, $usedBlobs
        );

        $res = new CheckBlobConsistencyResponse([$mbox]);
        $this->assertEquals([$mbox], $res->getMailboxes());

        $res = new CheckBlobConsistencyResponse();
        $res->setMailboxes([$mbox])
            ->addMailbox($mbox);
        $this->assertEquals([$mbox, $mbox], $res->getMailboxes());

        $res = new CheckBlobConsistencyResponse([$mbox]);
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckBlobConsistencyResponse>'
                . '<mbox id ="' . $id . '">'
                    .'<missingBlobs>'
                        .'<item id="' . $id . '" rev="' . $revision . '" s="' . $size . '" volumeId="' . $volumeId . '" blobPath="' . $blobPath . '" external="true" version="' . $version. '" />'
                    .'</missingBlobs>'
                    .'<incorrectSizes>'
                        . '<item id="' . $id . '" rev="' . $revision . '" s="' . $size . '" volumeId="' . $volumeId . '">'
                            . '<blob path="' . $path . '" s="' . $size . '" fileSize="' . $fileSize . '" external="true" />'
                        . '</item>'
                    .'</incorrectSizes>'
                    .'<unexpectedBlobs>'
                        . '<blob volumeId="' . $volumeId . '" path="' . $path . '" fileSize="' . $fileSize . '" external="true" />'
                    .'</unexpectedBlobs>'
                    .'<incorrectRevisions>'
                        . '<item id="' . $id . '" rev="' . $revision . '" s="' . $size . '" volumeId="' . $volumeId . '">'
                            . '<blob path="' . $path . '" fileSize="' . $fileSize . '" rev="' . $revision . '" external="true" />'
                        . '</item>'
                    .'</incorrectRevisions>'
                    .'<usedBlobs>'
                        . '<item id="' . $id . '" rev="' . $revision . '" s="' . $size . '" volumeId="' . $volumeId . '">'
                            . '<blob path="' . $path . '" s="' . $size . '" fileSize="' . $fileSize . '" external="true" />'
                        . '</item>'
                    .'</usedBlobs>'
                . '</mbox>'
            . '</CheckBlobConsistencyResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckBlobConsistencyResponse::class, 'xml'));

        $json = json_encode([
            'mbox' => [
                [
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
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckBlobConsistencyResponse::class, 'json'));
    }
}
