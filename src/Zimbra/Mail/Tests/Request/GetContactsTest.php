<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetContacts;
use Zimbra\Struct\AttributeName;
use Zimbra\Struct\Id;

/**
 * Testcase class for GetContacts.
 */
class GetContactsTest extends ZimbraMailApiTestCase
{
    public function testGetContactsRequest()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $folder = $this->faker->word;
        $sort = $this->faker->word;
        $max = mt_rand(1, 10);

        $a = new AttributeName($name);
        $ma = new AttributeName($name);
        $cn = new Id($id);

        $req = new GetContacts(
            true, $folder, $sort, true, true, $max, [$a], [$ma], [$cn]
        );
        $this->assertTrue($req->getSync());
        $this->assertSame($folder, $req->getFolderId());
        $this->assertSame($sort, $req->getSortBy());
        $this->assertTrue($req->getDerefGroupMember());
        $this->assertTrue($req->getReturnHiddenAttrs());
        $this->assertSame($max, $req->getMaxMembers());
        $this->assertSame([$a], $req->getAttributes()->all());
        $this->assertSame([$ma], $req->getMemberAttributes()->all());
        $this->assertSame([$cn], $req->getContacts()->all());

        $req = new GetContacts();
        $req->setSync(true)
            ->setFolderId($folder)
            ->setSortBy($sort)
            ->setDerefGroupMember(true)
            ->setReturnHiddenAttrs(true)
            ->setMaxMembers($max)
            ->setAttributes([$a])
            ->addAttribute($a)
            ->setMemberAttributes([$ma])
            ->addMemberAttribute($ma)
            ->setContacts([$cn])
            ->addContact($cn);
        $this->assertTrue($req->getSync());
        $this->assertSame($folder, $req->getFolderId());
        $this->assertSame($sort, $req->getSortBy());
        $this->assertTrue($req->getDerefGroupMember());
        $this->assertTrue($req->getReturnHiddenAttrs());
        $this->assertSame($max, $req->getMaxMembers());
        $this->assertSame([$a, $a], $req->getAttributes()->all());
        $this->assertSame([$ma, $ma], $req->getMemberAttributes()->all());
        $this->assertSame([$cn, $cn], $req->getContacts()->all());

        $req = new GetContacts(
            true, $folder, $sort, true, true, $max, [$a], [$ma], [$cn]
        );

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetContactsRequest sync="true" l="' . $folder . '" sortBy="' . $sort . '" derefGroupMember="true" returnHiddenAttrs="true" maxMembers="' . $max . '">'
                .'<a n="' . $name . '" />'
                .'<ma n="' . $name . '" />'
                .'<cn id="' . $id . '" />'
            .'</GetContactsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetContactsRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'sync' => true,
                'l' => $folder,
                'sortBy' => $sort,
                'derefGroupMember' => true,
                'returnHiddenAttrs' => true,
                'maxMembers' => $max,
                'a' => array(
                    array(
                        'n' => $name,
                    ),
                ),
                'ma' => array(
                    array(
                        'n' => $name,
                    ),
                ),
                'cn' => array(
                    array(
                        'id' => $id,
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetContactsApi()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $folder = $this->faker->word;
        $sort = $this->faker->word;
        $max = mt_rand(1, 10);

        $a = new AttributeName($name);
        $ma = new AttributeName($name);
        $cn = new Id($id);

        $this->api->getContacts(
            true, $folder, $sort, true, true, $max, [$a], [$ma], [$cn]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetContactsRequest sync="true" l="' . $folder . '" sortBy="' . $sort . '" derefGroupMember="true" returnHiddenAttrs="true" maxMembers="' . $max . '">'
                        .'<urn1:a n="' . $name . '" />'
                        .'<urn1:ma n="' . $name . '" />'
                        .'<urn1:cn id="' . $id . '" />'
                    .'</urn1:GetContactsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
