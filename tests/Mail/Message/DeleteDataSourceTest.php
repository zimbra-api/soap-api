<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\SerializerFactory;
use Zimbra\Mail\SerializerHandler;

use Zimbra\Mail\Message\DeleteDataSourceEnvelope;
use Zimbra\Mail\Message\DeleteDataSourceBody;
use Zimbra\Mail\Message\DeleteDataSourceRequest;
use Zimbra\Mail\Message\DeleteDataSourceResponse;

use Zimbra\Mail\Struct\CalDataSourceNameOrId;
use Zimbra\Mail\Struct\CaldavDataSourceNameOrId;
use Zimbra\Mail\Struct\GalDataSourceNameOrId;
use Zimbra\Mail\Struct\ImapDataSourceNameOrId;
use Zimbra\Mail\Struct\Pop3DataSourceNameOrId;
use Zimbra\Mail\Struct\RssDataSourceNameOrId;
use Zimbra\Mail\Struct\UnknownDataSourceNameOrId;
use Zimbra\Mail\Struct\YabDataSourceNameOrId;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeleteDataSource.
 */
class DeleteDataSourceTest extends ZimbraTestCase
{
    protected function setUp(): void
    {
        SerializerFactory::addSerializerHandler(new SerializerHandler);
        parent::setUp();
    }

    public function testDeleteDataSource()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;

        $cal = new CalDataSourceNameOrId($name, $id);
        $caldav = new CaldavDataSourceNameOrId($name, $id);
        $gal = new GalDataSourceNameOrId($name, $id);
        $imap = new ImapDataSourceNameOrId($name, $id);
        $pop3 = new Pop3DataSourceNameOrId($name, $id);
        $rss = new RssDataSourceNameOrId($name, $id);
        $unknown = new UnknownDataSourceNameOrId($name, $id);
        $yab = new YabDataSourceNameOrId($name, $id);

        $request = new DeleteDataSourceRequest([
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
        ], $request->getDataSources());

        $request = new DeleteDataSourceRequest();
        $request->setDataSources([
            $imap,
            $pop3,
            $caldav,
            $yab,
            $rss,
            $gal,
            $cal,
        ])
        ->addDataSource($unknown);
        $this->assertEquals([
            $imap,
            $pop3,
            $caldav,
            $yab,
            $rss,
            $gal,
            $cal,
            $unknown,
        ], $request->getDataSources());

        $response = new DeleteDataSourceResponse();

        $body = new DeleteDataSourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteDataSourceBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteDataSourceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteDataSourceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:DeleteDataSourceRequest>
            <imap name="$name" id="$id" />
            <pop3 name="$name" id="$id" />
            <caldav name="$name" id="$id" />
            <yab name="$name" id="$id" />
            <rss name="$name" id="$id" />
            <gal name="$name" id="$id" />
            <cal name="$name" id="$id" />
            <unknown name="$name" id="$id" />
        </urn:DeleteDataSourceRequest>
        <urn:DeleteDataSourceResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteDataSourceEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'DeleteDataSourceRequest' => [
                    'imap' => [
                        [
                            'id' => $id,
                            'name' => $name,
                        ],
                    ],
                    'pop3' => [
                        [
                            'id' => $id,
                            'name' => $name,
                        ],
                    ],
                    'caldav' => [
                        [
                            'id' => $id,
                            'name' => $name,
                        ],
                    ],
                    'yab' => [
                        [
                            'id' => $id,
                            'name' => $name,
                        ],
                    ],
                    'rss' => [
                        [
                            'id' => $id,
                            'name' => $name,
                        ],
                    ],
                    'gal' => [
                        [
                            'id' => $id,
                            'name' => $name,
                        ],
                    ],
                    'cal' => [
                        [
                            'id' => $id,
                            'name' => $name,
                        ],
                    ],
                    'unknown' => [
                        [
                            'id' => $id,
                            'name' => $name,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
                'DeleteDataSourceResponse' => [
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, DeleteDataSourceEnvelope::class, 'json'));
    }
}
