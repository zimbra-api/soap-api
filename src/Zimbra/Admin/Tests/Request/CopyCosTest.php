<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CopyCos;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Enum\CosBy;

/**
 * Testcase class for CopyCos.
 */
class CopyCosTest extends ZimbraAdminApiTestCase
{
    public function testCopyCosRequest()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $cos = new CosSelector(CosBy::NAME(), $value);
        $req = new CopyCos($name, $cos);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($name, $req->getNewName());
        $this->assertSame($cos, $req->getCos());

        $req->setNewName($name)
            ->setCos($cos);
        $this->assertSame($name, $req->getNewName());
        $this->assertSame($cos, $req->getCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CopyCosRequest>'
                . '<name>' . $name . '</name>'
                . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
            . '</CopyCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CopyCosRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'cos' => [
                    'by' => CosBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCopyCosApi()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $cos = new CosSelector(CosBy::NAME(), $value);
        $this->api->copyCos(
            $name, $cos
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CopyCosRequest>'
                        . '<urn1:name>' . $name . '</urn1:name>'
                        . '<urn1:cos by="' . CosBy::NAME() . '">' . $value . '</urn1:cos>'
                    . '</urn1:CopyCosRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
