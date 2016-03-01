<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\DeleteSignature;
use Zimbra\Account\Struct\NameId;

/**
 * Testcase class for DeleteSignature.
 */
class DeleteSignatureTest extends ZimbraAccountApiTestCase
{
    public function testDeleteSignatureRequest()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;

        $signature = new NameId($name, $id);
        $req = new DeleteSignature($signature);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($signature, $req->getSignature());

        $req->setSignature($signature);
        $this->assertSame($signature, $req->getSignature());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteSignatureRequest>'
                . '<signature name="' . $name . '" id="' . $id . '" />'
            . '</DeleteSignatureRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteSignatureRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'signature' => [
                    'name' => $name,
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteSignatureApi()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;
        $signature = new NameId($name, $id);

        $this->api->deleteSignature(
            $signature
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:DeleteSignatureRequest>'
                        . '<urn1:signature name="' . $name . '" id="' . $id . '" />'
                    . '</urn1:DeleteSignatureRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
