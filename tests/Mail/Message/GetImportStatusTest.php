<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\SerializerFactory;
use Zimbra\Mail\SerializerHandler;

use Zimbra\Mail\Message\GetImportStatusEnvelope;
use Zimbra\Mail\Message\GetImportStatusBody;
use Zimbra\Mail\Message\GetImportStatusRequest;
use Zimbra\Mail\Message\GetImportStatusResponse;

use Zimbra\Mail\Struct\ImapImportStatusInfo;
use Zimbra\Mail\Struct\Pop3ImportStatusInfo;
use Zimbra\Mail\Struct\CaldavImportStatusInfo;
use Zimbra\Mail\Struct\YabImportStatusInfo;
use Zimbra\Mail\Struct\RssImportStatusInfo;
use Zimbra\Mail\Struct\GalImportStatusInfo;
use Zimbra\Mail\Struct\CalImportStatusInfo;
use Zimbra\Mail\Struct\UnknownImportStatusInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetImportStatus.
 */
class GetImportStatusTest extends ZimbraTestCase
{
    protected function setUp(): void
    {
        SerializerFactory::addSerializerHandler(new SerializerHandler);
        parent::setUp();
    }

    public function testGetImportStatus()
    {
        $id = $this->faker->uuid;
        $error = $this->faker->word;

        $imap = new ImapImportStatusInfo(
            $id, TRUE, TRUE, $error
        );
        $pop3 = new Pop3ImportStatusInfo(
            $id, TRUE, TRUE, $error
        );
        $caldav = new CaldavImportStatusInfo(
            $id, TRUE, TRUE, $error
        );
        $yab = new YabImportStatusInfo(
            $id, TRUE, TRUE, $error
        );
        $rss = new RssImportStatusInfo(
            $id, TRUE, TRUE, $error
        );
        $gal = new GalImportStatusInfo(
            $id, TRUE, TRUE, $error
        );
        $cal = new CalImportStatusInfo(
            $id, TRUE, TRUE, $error
        );
        $unknown = new UnknownImportStatusInfo(
            $id, TRUE, TRUE, $error
        );

        $request = new GetImportStatusRequest();
        $response = new GetImportStatusResponse([
            $imap,
            $pop3,
            $caldav,
            $yab,
            $rss,
            $gal,
            $cal,
            $unknown,
        ]);
        $this->assertEquals([
            $imap,
            $pop3,
            $caldav,
            $yab,
            $rss,
            $gal,
            $cal,
            $unknown,
        ], $response->getStatuses());
        $response = new GetImportStatusResponse();
        $response->setStatuses([
            $imap,
            $pop3,
            $caldav,
            $yab,
            $rss,
            $gal,
            $cal,
        ])
        ->addStatus($unknown);
        $this->assertEquals([
            $imap,
            $pop3,
            $caldav,
            $yab,
            $rss,
            $gal,
            $cal,
            $unknown,
        ], $response->getStatuses());

        $body = new GetImportStatusBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetImportStatusBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetImportStatusEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetImportStatusEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetImportStatusRequest />
        <urn:GetImportStatusResponse>
            <imap id="$id" isRunning="true" success="true" error="$error" />
            <pop3 id="$id" isRunning="true" success="true" error="$error" />
            <caldav id="$id" isRunning="true" success="true" error="$error" />
            <yab id="$id" isRunning="true" success="true" error="$error" />
            <rss id="$id" isRunning="true" success="true" error="$error" />
            <gal id="$id" isRunning="true" success="true" error="$error" />
            <cal id="$id" isRunning="true" success="true" error="$error" />
            <unknown id="$id" isRunning="true" success="true" error="$error" />
        </urn:GetImportStatusResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetImportStatusEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetImportStatusRequest' => [
                    '_jsns' => 'urn:zimbraMail',
                ],
                'GetImportStatusResponse' => [
                    'imap' => [
                        [
                            'id' => $id,
                            'isRunning' => TRUE,
                            'success' => TRUE,
                            'error' => $error,
                        ],
                    ],
                    'pop3' => [
                        [
                            'id' => $id,
                            'isRunning' => TRUE,
                            'success' => TRUE,
                            'error' => $error,
                        ],
                    ],
                    'caldav' => [
                        [
                            'id' => $id,
                            'isRunning' => TRUE,
                            'success' => TRUE,
                            'error' => $error,
                        ],
                    ],
                    'yab' => [
                        [
                            'id' => $id,
                            'isRunning' => TRUE,
                            'success' => TRUE,
                            'error' => $error,
                        ],
                    ],
                    'rss' => [
                        [
                            'id' => $id,
                            'isRunning' => TRUE,
                            'success' => TRUE,
                            'error' => $error,
                        ],
                    ],
                    'gal' => [
                        [
                            'id' => $id,
                            'isRunning' => TRUE,
                            'success' => TRUE,
                            'error' => $error,
                        ],
                    ],
                    'cal' => [
                        [
                            'id' => $id,
                            'isRunning' => TRUE,
                            'success' => TRUE,
                            'error' => $error,
                        ],
                    ],
                    'unknown' => [
                        [
                            'id' => $id,
                            'isRunning' => TRUE,
                            'success' => TRUE,
                            'error' => $error,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetImportStatusEnvelope::class, 'json'));
    }
}
