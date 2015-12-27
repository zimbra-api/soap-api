<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\CreateSignature;
use Zimbra\Account\Struct\SignatureContent;
use Zimbra\Account\Struct\Signature;
use Zimbra\Enum\ContentType;

/**
 * Testcase class for CreateSignature.
 */
class CreateSignatureTest extends ZimbraAccountApiTestCase
{
    public function testCreateSignatureRequest()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->word;
        $cid = $this->faker->word;

        $content = new SignatureContent($value, ContentType::TEXT_PLAIN());
        $signature = new Signature($name, $id, $cid, [$content]);

        $req = new CreateSignature($signature);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($signature, $req->getSignature());

        $req->setSignature($signature);
        $this->assertSame($signature, $req->getSignature());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateSignatureRequest>'
                . '<signature id="' . $id . '" name="' . $name . '">'
                    . '<cid>' . $cid . '</cid>'
                    . '<content type="text/plain">' . $value . '</content>'
                . '</signature>'
            . '</CreateSignatureRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateSignatureRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'signature' => [
                    'name' => $name,
                    'id' => $id,
                    'cid' => $cid,
                    'content' => [
                        [
                            'type' => 'text/plain',
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateSignatureApi()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->word;
        $cid = $this->faker->word;
        $content = new SignatureContent($value, ContentType::TEXT_PLAIN());
        $signature = new Signature($name, $id, $cid, [$content]);

        $this->api->createSignature(
            $signature
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:CreateSignatureRequest>'
                        . '<urn1:signature id="' . $id . '" name="' . $name . '">'
                            . '<urn1:cid>' . $cid . '</urn1:cid>'
                            . '<urn1:content type="' . ContentType::TEXT_PLAIN() . '">' . $value . '</urn1:content>'
                        . '</urn1:signature>'
                    . '</urn1:CreateSignatureRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
