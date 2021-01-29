<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ExportAndDeleteItemsBody;
use Zimbra\Admin\Message\ExportAndDeleteItemsEnvelope;
use Zimbra\Admin\Message\ExportAndDeleteItemsRequest;
use Zimbra\Admin\Message\ExportAndDeleteItemsResponse;
use Zimbra\Admin\Struct\ExportAndDeleteItemSpec;
use Zimbra\Admin\Struct\ExportAndDeleteMailboxSpec;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for ExportAndDeleteItems.
 */
class ExportAndDeleteItemsTest extends ZimbraStructTestCase
{
    public function testExportAndDeleteItems()
    {
        $id = mt_rand(1, 100);
        $version = mt_rand(1, 100);
        $exportDir = $this->faker->word;
        $exportFilenamePrefix = $this->faker->word;

        $item = new ExportAndDeleteItemSpec($id, $version);
        $mbox = new ExportAndDeleteMailboxSpec($id, [$item]);

        $request = new ExportAndDeleteItemsRequest($mbox, $exportDir, $exportFilenamePrefix);
        $this->assertSame($mbox, $request->getMailbox());
        $this->assertSame($exportDir, $request->getExportDir());
        $this->assertSame($exportFilenamePrefix, $request->getExportFilenamePrefix());
        $request = new ExportAndDeleteItemsRequest(new ExportAndDeleteMailboxSpec(0));
        $request->setMailbox($mbox)
            ->setExportDir($exportDir)
            ->setExportFilenamePrefix($exportFilenamePrefix);
        $this->assertSame($mbox, $request->getMailbox());
        $this->assertSame($exportDir, $request->getExportDir());
        $this->assertSame($exportFilenamePrefix, $request->getExportFilenamePrefix());

        $response = new ExportAndDeleteItemsResponse();

        $body = new ExportAndDeleteItemsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ExportAndDeleteItemsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ExportAndDeleteItemsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ExportAndDeleteItemsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ExportAndDeleteItemsRequest exportDir="$exportDir" exportFilenamePrefix="$exportFilenamePrefix">
            <mbox id="$id">
                <item id="$id" version="$version" />
            </mbox>
        </urn:ExportAndDeleteItemsRequest>
        <urn:ExportAndDeleteItemsResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ExportAndDeleteItemsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ExportAndDeleteItemsRequest' => [
                    'exportDir' => $exportDir,
                    'exportFilenamePrefix' => $exportFilenamePrefix,
                    'mbox' => [
                        'id' => $id,
                        'item' => [
                            [
                                'id' => $id,
                                'version' => $version,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'ExportAndDeleteItemsResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ExportAndDeleteItemsEnvelope::class, 'json'));
    }
}
