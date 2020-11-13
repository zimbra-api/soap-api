<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\CheckDirectoryResponse;
use Zimbra\Admin\Struct\DirPathInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckDirectoryResponse.
 */
class CheckDirectoryResponseTest extends ZimbraStructTestCase
{
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
}
