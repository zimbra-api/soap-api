<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetDelegatedAdminConstraints;
use Zimbra\Enum\TargetType;
use Zimbra\Struct\NamedElement;

/**
 * Testcase class for GetDelegatedAdminConstraints.
 */
class GetDelegatedAdminConstraintsTest extends ZimbraAdminApiTestCase
{
    public function testGetDelegatedAdminConstraintsRequest()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;

        $attr = new NamedElement($name);
        $req = new GetDelegatedAdminConstraints(
            TargetType::ACCOUNT(), $id, $name, [$attr]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('account', $req->getType()->value());
        $this->assertSame($id, $req->getId());
        $this->assertSame($name, $req->getName());
        $this->assertSame([$attr], $req->getAttrs()->all());

        $req->setType(TargetType::DOMAIN())
            ->setId($id)
            ->setName($name)
            ->addAttr($attr);
        $this->assertSame('domain', $req->getType()->value());
        $this->assertSame($id, $req->getId());
        $this->assertSame($name, $req->getName());
        $this->assertSame([$attr, $attr], $req->getAttrs()->all());
        $req->getAttrs()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDelegatedAdminConstraintsRequest type="' . TargetType::DOMAIN() . '" id="' . $id . '" name="' . $name . '">'
                . '<a name="' . $name . '" />'
            . '</GetDelegatedAdminConstraintsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDelegatedAdminConstraintsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'type' => TargetType::DOMAIN()->value(),
                'id' => $id,
                'name' => $name,
                'a' => [
                    [
                        'name' => $name,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDelegatedAdminConstraintsApi()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;
        $attr = new NamedElement($name);

        $this->api->getDelegatedAdminConstraints(
            TargetType::DOMAIN(), $id, $name, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetDelegatedAdminConstraintsRequest type="' . TargetType::DOMAIN() . '" id="' . $id . '" name="' . $name . '">'
                        . '<urn1:a name="' . $name . '" />'
                    . '</urn1:GetDelegatedAdminConstraintsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
