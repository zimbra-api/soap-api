<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckBlobConsistencyBody;
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
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckBlobConsistencyBody.
 */
class CheckBlobConsistencyBodyTest extends ZimbraStructTestCase
{
    public function testCheckBlobConsistencyBody()
    {
        $id = mt_rand(1, 100);
        $revision = mt_rand(1, 100);
        $size = mt_rand(1, 100);
        $volumeId = mt_rand(1, 100);
        $blobPath = $this->faker->word;
        $version = mt_rand(1, 100);
        $path = $this->faker->word;
        $fileSize = mt_rand(1, 100);
        $mboxId = mt_rand(1, 100);

        $volume = new IntIdAttr($volumeId);
        $reqMbox = new IntIdAttr($mboxId);

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
        $resMbox = new MailboxBlobConsistency(
            $id, $missingBlobs, $incorrectSizes, $unexpectedBlobs, $incorrectRevisions, $usedBlobs
        );

        $request = new CheckBlobConsistencyRequest(
            TRUE, TRUE, [$volume], [$reqMbox]
        );
        $response = new CheckBlobConsistencyResponse([$resMbox]);

        $body = new CheckBlobConsistencyBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckBlobConsistencyBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CheckBlobConsistencyRequest checkSize="true" reportUsedBlobs="true">'
                    . '<volume id="' . $volumeId . '" />'
                    . '<mbox id="' . $mboxId . '" />'
                . '</urn:CheckBlobConsistencyRequest>'
                . '<urn:CheckBlobConsistencyResponse>'
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
                . '</urn:CheckBlobConsistencyResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CheckBlobConsistencyBody::class, 'xml'));

        $json = json_encode([
            'CheckBlobConsistencyRequest' => [
                'checkSize' => TRUE,
                'reportUsedBlobs' => TRUE,
                'volume' => [
                    [
                        'id' => $volumeId,
                    ]
                ],
                'mbox' => [
                    [
                        'id' => $mboxId,
                    ]
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CheckBlobConsistencyResponse' => [
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
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CheckBlobConsistencyBody::class, 'json'));
    }
}
