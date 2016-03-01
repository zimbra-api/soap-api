<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\UploadDomCert;

/**
 * Testcase class for UploadDomCert.
 */
class UploadDomCertTest extends ZimbraAdminApiTestCase
{
    public function testUploadDomCertRequest()
    {
        $certAid = $this->faker->word;
        $certFilename = $this->faker->word;
        $keyAid = $this->faker->word;
        $keyFilename = $this->faker->word;

        $req = new UploadDomCert(
            $certAid, $certFilename, $keyAid, $keyFilename
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($certAid, $req->getCertAid());
        $this->assertEquals($certFilename, $req->getCertFilename());
        $this->assertEquals($keyAid, $req->getKeyAid());
        $this->assertEquals($keyFilename, $req->getKeyFilename());

        $req->setCertAid($certAid)
            ->setCertFilename($certFilename)
            ->setKeyAid($keyAid)
            ->setKeyFilename($keyFilename);
        $this->assertEquals($certAid, $req->getCertAid());
        $this->assertEquals($certFilename, $req->getCertFilename());
        $this->assertEquals($keyAid, $req->getKeyAid());
        $this->assertEquals($keyFilename, $req->getKeyFilename());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<UploadDomCertRequest '
                . 'cert.aid="' . $certAid . '" '
                . 'cert.filename="' . $certFilename . '" '
                . 'key.aid="' . $keyAid . '" '
                . 'key.filename="' . $keyFilename . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'UploadDomCertRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'cert.aid' => $certAid,
                'cert.filename' => $certFilename,
                'key.aid' => $keyAid,
                'key.filename' => $keyFilename,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testUploadDomCertApi()
    {
        $certAid = $this->faker->word;
        $certFilename = $this->faker->word;
        $keyAid = $this->faker->word;
        $keyFilename = $this->faker->word;
        $this->api->uploadDomCert(
            $certAid, $certFilename, $keyAid, $keyFilename
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:UploadDomCertRequest '
                        . 'cert.aid="' . $certAid . '" '
                        . 'cert.filename="' . $certFilename . '" '
                        . 'key.aid="' . $keyAid . '" '
                        . 'key.filename="' . $keyFilename . '" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
