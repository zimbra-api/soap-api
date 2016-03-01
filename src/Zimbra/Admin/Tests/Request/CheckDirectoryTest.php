<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CheckDirectory;
use Zimbra\Admin\Struct\CheckDirSelector;

/**
 * Testcase class for CheckDirectory.
 */
class CheckDirectoryTest extends ZimbraAdminApiTestCase
{
    public function testCheckDirectoryRequest()
    {
        $path = $this->faker->word;
        $dir = new CheckDirSelector($path, true);
        $req = new CheckDirectory([$dir]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$dir], $req->getDirectories()->all());

        $req->addDirectory($dir);
        $this->assertSame([$dir, $dir], $req->getDirectories()->all());
        $req->getDirectories()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckDirectoryRequest>'
                . '<directory path="' . $path . '" create="true" />'
            . '</CheckDirectoryRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckDirectoryRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'directory' => [
                    [
                        'path' => $path,
                        'create' => true,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckDirectoryApi()
    {
        $path = $this->faker->word;
        $dir = new CheckDirSelector($path, true);

        $this->api->checkDirectory(
            [$dir]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckDirectoryRequest>'
                        . '<urn1:directory path="' . $path . '" create="true" />'
                    . '</urn1:CheckDirectoryRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
