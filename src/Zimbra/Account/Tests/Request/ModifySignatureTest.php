<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\ModifySignature;
use Zimbra\Account\Struct\SignatureContent;
use Zimbra\Account\Struct\Signature;
use Zimbra\Enum\ContentType;

/**
 * Testcase class for ModifySignature.
 */
class ModifySignatureTest extends ZimbraAccountApiTestCase
{
    public function testModifySignatureRequest()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->word;
        $cid = $this->faker->word;

        $content = new SignatureContent($value, ContentType::TEXT_HTML());
        $signature = new Signature($name, $id, $cid, [$content]);

        $req = new ModifySignature($signature);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($signature, $req->getSignature());
        $req->setSignature($signature);
        $this->assertSame($signature, $req->getSignature());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifySignatureRequest>'
                . '<signature name="' . $name . '" id="' . $id . '">'
                    . '<cid>' . $cid . '</cid>'
                    . '<content type="' . ContentType::TEXT_HTML() . '">' . $value . '</content>'
                . '</signature>'
            . '</ModifySignatureRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifySignatureRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'signature' => [
                    'name' => $name,
                    'id' => $id,
                    'cid' => $cid,
                    'content' => [
                        [
                            'type' => ContentType::TEXT_HTML()->value(),
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifySignatureApi()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->word;
        $cid = $this->faker->word;
        $content = new SignatureContent($value, ContentType::TEXT_HTML());
        $signature = new Signature($name, $id, $cid, [$content]);

        $this->api->modifySignature($signature);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:ModifySignatureRequest>'
                        . '<urn1:signature name="' . $name . '" id="' . $id . '">'
                            . '<urn1:cid>' . $cid . '</urn1:cid>'
                            . '<urn1:content type="' . ContentType::TEXT_HTML() . '">' . $value . '</urn1:content>'
                        . '</urn1:signature>'
                    . '</urn1:ModifySignatureRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
