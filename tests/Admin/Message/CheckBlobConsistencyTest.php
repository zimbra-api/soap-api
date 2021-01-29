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
        $resMbox = new MailboxBlobConsistency(
            $id, $missingBlobs, $incorrectSizes, $unexpectedBlobs, $incorrectRevisions, $usedBlobs
        );

        $request = new CheckBlobConsistencyRequest(
            FALSE, FALSE, [$volume], [$reqMbox]
        );
        $this->assertFalse($request->getCheckSize());
        $this->assertFalse($request->getReportUsedBlobs());
        $this->assertEquals([$volume], $request->getVolumes());
        $this->assertEquals([$reqMbox], $request->getMailboxes());

        $request = new CheckBlobConsistencyRequest();
        $request->setCheckSize(TRUE)
            ->setReportUsedBlobs(TRUE)
            ->setVolumes([$volume])
            ->addVolume($volume)
            ->setMailboxes([$reqMbox])
            ->addMailbox($reqMbox);
        $this->assertTrue($request->getCheckSize());
        $this->assertTrue($request->getReportUsedBlobs());
        $this->assertEquals([$volume, $volume], $request->getVolumes());
        $this->assertEquals([$reqMbox, $reqMbox], $request->getMailboxes());
        $request->setVolumes([$volume])
            ->setMailboxes([$reqMbox]);

        $response = new CheckBlobConsistencyResponse([$resMbox]);
        $this->assertEquals([$resMbox], $response->getMailboxes());

        $response = new CheckBlobConsistencyResponse();
        $response->setMailboxes([$resMbox])
            ->addMailbox($resMbox);
        $this->assertEquals([$resMbox, $resMbox], $response->getMailboxes());
        $response->setMailboxes([$resMbox]);

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
            <volume id="$volumeId" />
            <mbox id="$mboxId" />
        </urn:CheckBlobConsistencyRequest>
        <urn:CheckBlobConsistencyResponse>
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
        </urn:CheckBlobConsistencyResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckBlobConsistencyEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
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
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckBlobConsistencyEnvelope::class, 'json'));
    }
}
