<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\VerifyCertKey;

/**
 * Testcase class for VerifyCertKey.
 */
class VerifyCertKeyTest extends ZimbraAdminApiTestCase
{
    public function testVerifyCertKeyRequest()
    {
        $cert = $this->faker->word;
        $privkey = $this->faker->word;
        $req = new VerifyCertKey($cert, $privkey);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($cert, $req->getCert());
        $this->assertEquals($privkey, $req->getPrivateKey());

        $req->setCert($cert)
            ->setPrivateKey($privkey);
        $this->assertEquals($cert, $req->getCert());
        $this->assertEquals($privkey, $req->getPrivateKey());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<VerifyCertKeyRequest '
                . 'cert="' . $cert . '" '
                . 'privkey="' . $privkey . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'VerifyCertKeyRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'cert' => $cert,
                'privkey' => $privkey,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testVerifyCertKeyApi()
    {
        $cert = $this->faker->word;
        $privkey = $this->faker->word;
        $this->api->verifyCertKey(
            $cert, $privkey
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:VerifyCertKeyRequest '
                        . 'cert="' . $cert . '" '
                        . 'privkey="' . $privkey . '" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
