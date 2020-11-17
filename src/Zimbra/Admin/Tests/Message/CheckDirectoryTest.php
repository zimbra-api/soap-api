<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\CheckDirectoryBody;
use Zimbra\Admin\Message\CheckDirectoryEnvelope;
use Zimbra\Admin\Message\CheckDirectoryRequest;
use Zimbra\Admin\Message\CheckDirectoryResponse;
use Zimbra\Admin\Struct\CheckDirSelector;
use Zimbra\Admin\Struct\DirPathInfo;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckDirectory.
 */
class CheckDirectoryTest extends ZimbraStructTestCase
{
    public function testCheckDirectoryRequest()
    {
        $path = $this->faker->word;
        $dir = new CheckDirSelector($path, TRUE);

        $req = new CheckDirectoryRequest(
            [$dir]
        );

        $this->assertSame([$dir], $req->getPaths());

        $req = new CheckDirectoryRequest();
        $req->setPaths([$dir])
            ->addPath($dir);
        $this->assertSame([$dir, $dir], $req->getPaths());

        $req = new CheckDirectoryRequest(
            [$dir]
        );
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckDirectoryRequest>'
                . '<directory path="' . $path . '" create="true" />'
            . '</CheckDirectoryRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckDirectoryRequest::class, 'xml'));

        $json = json_encode([
            'directory' => [
                [
                    'path' => $path,
                    'create' => TRUE,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckDirectoryRequest::class, 'json'));
    }

    public function testCheckDirectoryResponse()
    {
        $path = $this->faker->word;
        $dir = new DirPathInfo($path, TRUE, TRUE, TRUE, TRUE);

        $res = new CheckDirectoryResponse(
            [$dir]
        );

        $this->assertSame([$dir], $res->getPaths());

        $res = new CheckDirectoryResponse();
        $res->setPaths([$dir])
            ->addPath($dir);
        $this->assertSame([$dir, $dir], $res->getPaths());

        $res = new CheckDirectoryResponse(
            [$dir]
        );
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckDirectoryResponse>'
                . '<directory path="' . $path . '" exists="true" isDirectory="true" readable="true" writable="true" />'
            . '</CheckDirectoryResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckDirectoryResponse::class, 'xml'));

        $json = json_encode([
            'directory' => [
                [
                    'path' => $path,
                    'exists' => TRUE,
                    'isDirectory' => TRUE,
                    'readable' => TRUE,
                    'writable' => TRUE,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckDirectoryResponse::class, 'json'));
    }

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
