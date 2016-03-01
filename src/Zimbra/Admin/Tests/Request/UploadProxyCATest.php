<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\UploadProxyCA;

/**
 * Testcase class for UploadProxyCA.
 */
class UploadProxyCATest extends ZimbraAdminApiTestCase
{
    public function testUploadProxyCARequest()
    {
        $certAid = $this->faker->word;
        $certFilename = $this->faker->word;
        $req = new UploadProxyCA($certAid, $certFilename);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($certAid, $req->getCertAid());
        $this->assertEquals($certFilename, $req->getCertFilename());

        $req->setCertAid($certAid)
            ->setCertFilename($certFilename);
        $this->assertEquals($certAid, $req->getCertAid());
        $this->assertEquals($certFilename, $req->getCertFilename());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<UploadProxyCARequest '
                . 'cert.aid="' . $certAid . '" '
                . 'cert.filename="' . $certFilename . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'UploadProxyCARequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'cert.aid' => $certAid,
                'cert.filename' => $certFilename,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testUploadProxyCAApi()
    {
        $certAid = $this->faker->word;
        $certFilename = $this->faker->word;
        $this->api->uploadProxyCA(
            $certAid, $certFilename
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:UploadProxyCARequest '
                        . 'cert.aid="' . $certAid . '" '
                        . 'cert.filename="' . $certFilename . '" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
