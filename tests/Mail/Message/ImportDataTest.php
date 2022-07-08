<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\ImportDataEnvelope;
use Zimbra\Mail\Message\ImportDataBody;
use Zimbra\Mail\Message\ImportDataRequest;
use Zimbra\Mail\Message\ImportDataResponse;

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
 * Testcase class for ImportData.
 */
class ImportDataTest extends ZimbraTestCase
{
    public function testImportData()
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

        $request = new ImportDataRequest([
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

        $request = new ImportDataRequest();
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

        $response = new ImportDataResponse();

        $body = new ImportDataBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ImportDataBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ImportDataEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ImportDataEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:ImportDataRequest>
            <urn:imap name="$name" id="$id" />
            <urn:pop3 name="$name" id="$id" />
            <urn:caldav name="$name" id="$id" />
            <urn:yab name="$name" id="$id" />
            <urn:rss name="$name" id="$id" />
            <urn:gal name="$name" id="$id" />
            <urn:cal name="$name" id="$id" />
            <urn:unknown name="$name" id="$id" />
        </urn:ImportDataRequest>
        <urn:ImportDataResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ImportDataEnvelope::class, 'xml'));
    }
}
