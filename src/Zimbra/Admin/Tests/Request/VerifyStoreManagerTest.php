<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\VerifyStoreManager;

/**
 * Testcase class for VerifyStoreManager.
 */
class VerifyStoreManagerTest extends ZimbraAdminApiTestCase
{
    public function testVerifyStoreManagerRequest()
    {
        $size = mt_rand(0, 100);
        $num = mt_rand(0, 100);

        $req = new VerifyStoreManager($size, $num, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($size, $req->getFileSize());
        $this->assertEquals($num, $req->getNum());
        $this->assertFalse($req->getCheckBlobs());

        $req->setFileSize($size)
            ->setNum($num)
            ->setCheckBlobs(true);
        $this->assertEquals($size, $req->getFileSize());
        $this->assertEquals($num, $req->getNum());
        $this->assertTrue($req->getCheckBlobs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<VerifyStoreManagerRequest '
                . 'fileSize="' . $size . '" '
                . 'num="' . $num . '" '
                . 'checkBlobs="true" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'VerifyStoreManagerRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'fileSize' => $size,
                'num' => $num,
                'checkBlobs' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testVerifyStoreManagerApi()
    {
        $size = mt_rand(0, 100);
        $num = mt_rand(0, 100);
        $this->api->verifyStoreManager(
            $size, $num, true
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:VerifyStoreManagerRequest '
                        . 'fileSize="' . $size . '" '
                        . 'num="' . $num . '" '
                        . 'checkBlobs="true" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
