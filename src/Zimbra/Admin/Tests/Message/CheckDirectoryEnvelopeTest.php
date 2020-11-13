<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckDirectoryBody;
use Zimbra\Admin\Message\CheckDirectoryEnvelope;
use Zimbra\Admin\Message\CheckDirectoryRequest;
use Zimbra\Admin\Message\CheckDirectoryResponse;
use Zimbra\Admin\Struct\CheckDirSelector;
use Zimbra\Admin\Struct\DirPathInfo;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckDirectoryEnvelope.
 */
class CheckDirectoryEnvelopeTest extends ZimbraStructTestCase
{
    public function testCheckDirectoryEnvelope()
    {
        $path = $this->faker->word;

        $request = new CheckDirectoryRequest(
            [new CheckDirSelector($path, TRUE)]
        );
        $response = new CheckDirectoryResponse(
            [new DirPathInfo($path, TRUE, TRUE, TRUE, TRUE)]
        );
        $body = new CheckDirectoryBody($request, $response);

        $envelope = new CheckDirectoryEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckDirectoryEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CheckDirectoryRequest>'
                        . '<directory path="' . $path . '" create="true" />'
                    . '</urn:CheckDirectoryRequest>'
                    . '<urn:CheckDirectoryResponse>'
                        . '<directory path="' . $path . '" exists="true" isDirectory="true" readable="true" writable="true" />'
                    . '</urn:CheckDirectoryResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckDirectoryEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CheckDirectoryRequest' => [
                    'directory' => [
                        [
                            'path' => $path,
                            'create' => TRUE,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CheckDirectoryResponse' => [
                    'directory' => [
                        [
                            'path' => $path,
                            'exists' => TRUE,
                            'isDirectory' => TRUE,
                            'readable' => TRUE,
                            'writable' => TRUE,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckDirectoryEnvelope::class, 'json'));
    }
}
