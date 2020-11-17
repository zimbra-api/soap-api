<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

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
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckBlobConsistency.
 */
class CheckBlobConsistencyTest extends ZimbraStructTestCase
{
    public function testCheckBlobConsistencyRequest()
    {
        $volumeId = mt_rand(1, 100);
        $mboxId = mt_rand(1, 100);

        $volume = new IntIdAttr($volumeId);
        $mbox = new IntIdAttr($mboxId);
        $req = new CheckBlobConsistencyRequest(
            FALSE, FALSE, [$volume], [$mbox]
        );

        $this->assertFalse($req->getCheckSize());
        $this->assertFalse($req->getReportUsedBlobs());
        $this->assertEquals([$volume], $req->getVolumes());
        $this->assertEquals([$mbox], $req->getMailboxes());

        $req = new CheckBlobConsistencyRequest();
        $req->setCheckSize(TRUE)
            ->setReportUsedBlobs(TRUE)
            ->setVolumes([$volume])
            ->addVolume($volume)
            ->setMailboxes([$mbox])
            ->addMailbox($mbox);
        $this->assertTrue($req->getCheckSize());
        $this->assertTrue($req->getReportUsedBlobs());
        $this->assertEquals([$volume, $volume], $req->getVolumes());
        $this->assertEquals([$mbox, $mbox], $req->getMailboxes());

        $req = new CheckBlobConsistencyRequest(
            TRUE, TRUE, [$volume], [$mbox]
        );
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckBlobConsistencyRequest checkSize="true" reportUsedBlobs="true">'
                . '<volume id="' . $volumeId . '" />'
                . '<mbox id="' . $mboxId . '" />'
            . '</CheckBlobConsistencyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckBlobConsistencyRequest::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckBlobConsistencyRequest::class, 'json'));
    }

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

    public function testCheckBlobConsistencyEnvelope()
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
            TRUE, TRUE, [$volume], [$reqMbox]
        );
        $response = new CheckBlobConsistencyResponse([$resMbox]);
        $body = new CheckBlobConsistencyBody($request, $response);

        $envelope = new CheckBlobConsistencyEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckBlobConsistencyEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
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
                . '</soap:Body>'
            . '</soap:Envelope>';
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
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckBlobConsistencyEnvelope::class, 'json'));
    }
}
