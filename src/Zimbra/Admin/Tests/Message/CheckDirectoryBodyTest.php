<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckDirectoryBody;
use Zimbra\Admin\Message\CheckDirectoryRequest;
use Zimbra\Admin\Message\CheckDirectoryResponse;
use Zimbra\Admin\Struct\CheckDirSelector;
use Zimbra\Admin\Struct\DirPathInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckDirectoryBody.
 */
class CheckDirectoryBodyTest extends ZimbraStructTestCase
{
    public function testCheckDirectoryBody()
    {
        $path = $this->faker->word;

        $request = new CheckDirectoryRequest(
            [new CheckDirSelector($path, TRUE)]
        );
        $response = new CheckDirectoryResponse(
            [new DirPathInfo($path, TRUE, TRUE, TRUE, TRUE)]
        );

        $body = new CheckDirectoryBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckDirectoryBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CheckDirectoryRequest>'
                    . '<directory path="' . $path . '" create="true" />'
                . '</urn:CheckDirectoryRequest>'
                . '<urn:CheckDirectoryResponse>'
                    . '<directory path="' . $path . '" exists="true" isDirectory="true" readable="true" writable="true" />'
                . '</urn:CheckDirectoryResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CheckDirectoryBody::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CheckDirectoryBody::class, 'json'));
    }
}
