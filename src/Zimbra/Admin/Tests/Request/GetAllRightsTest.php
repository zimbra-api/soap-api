<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAllRights;
use Zimbra\Enum\RightClass;

/**
 * Testcase class for GetAllRights.
 */
class GetAllRightsTest extends ZimbraAdminApiTestCase
{
    public function testGetAllRightsRequest()
    {
        $type = $this->faker->word;
        $req = new GetAllRights($type, false, RightClass::ADMIN());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($type, $req->getTargetType());
        $this->assertFalse($req->getExpandAllAttrs());
        $this->assertSame('ADMIN', $req->getRightClass()->value());

        $req->setTargetType($type)
            ->setExpandAllAttrs(true)
            ->setRightClass(RightClass::ALL());
        $this->assertSame($type, $req->getTargetType());
        $this->assertTrue($req->getExpandAllAttrs());
        $this->assertSame('ALL', $req->getRightClass()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllRightsRequest targetType="' . $type . '" expandAllAttrs="true" rightClass="' . RightClass::ALL() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllRightsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'targetType' => $type,
                'expandAllAttrs' => true,
                'rightClass' => RightClass::ALL()->value(),
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllRightsApi()
    {
        $type = $this->faker->word;
        $this->api->getAllRights($type, true, RightClass::ALL());

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllRightsRequest targetType="' . $type . '" expandAllAttrs="true" rightClass="' . RightClass::ALL() . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
