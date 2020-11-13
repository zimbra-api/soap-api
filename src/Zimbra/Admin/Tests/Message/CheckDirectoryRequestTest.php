<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Message\CheckDirectoryRequest;
use Zimbra\Admin\Struct\CheckDirSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckDirectoryRequest.
 */
class CheckDirectoryRequestTest extends ZimbraStructTestCase
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
}
