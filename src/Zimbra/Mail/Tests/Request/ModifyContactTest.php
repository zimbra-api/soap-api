<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\MemberType;
use Zimbra\Mail\Request\ModifyContact;
use Zimbra\Mail\Struct\ModifyContactAttr;
use Zimbra\Mail\Struct\ModifyContactGroupMember;
use Zimbra\Mail\Struct\ModifyContactSpec;

/**
 * Testcase class for ModifyContact.
 */
class ModifyContactTest extends ZimbraMailApiTestCase
{
    public function testModifyContactRequest()
    {
        $id = mt_rand(1, 10);
        $name = $this->faker->word;
        $value = $this->faker->word;
        $aid = $this->faker->uuid;
        $part = $this->faker->word;
        $op = $this->faker->randomElement(['+', '-', 'reset']);
        $tn = $this->faker->word;

        $a = new ModifyContactAttr(
            $name, $value, $aid, $id, $part, $op
        );
        $m = new ModifyContactGroupMember(
            MemberType::CONTACT(), $value, $op
        );
        $cn = new ModifyContactSpec(
            $id, $tn, [$a], [$m]
        );

        $req = new ModifyContact(
            $cn, true, true
        );
        $this->assertSame($cn, $req->getContact());
        $this->assertTrue($req->getReplace());
        $this->assertTrue($req->getVerbose());

        $req = new ModifyContact(
            new ModifyContactSpec()
        );
        $req->setContact($cn)
            ->setReplace(true)
            ->setVerbose(true);
        $this->assertSame($cn, $req->getContact());
        $this->assertTrue($req->getReplace());
        $this->assertTrue($req->getVerbose());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyContactRequest replace="true" verbose="true">'
                .'<cn id="' . $id . '" tn="' . $tn . '">'
                    .'<a n="' . $name . '" aid="' . $aid . '" id="' . $id . '" part="' . $part . '" op="' . $op . '">' . $value . '</a>'
                    .'<m type="' . MemberType::CONTACT() . '" value="' . $value . '" op="' . $op . '" />'
                .'</cn>'
            .'</ModifyContactRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyContactRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'replace' => true,
                'verbose' => true,
                'cn' => array(
                    'id' => $id,
                    'tn' => $tn,
                    'a' => array(
                        array(
                            'n' => $name,
                            '_content' => $value,
                            'aid' => $aid,
                            'id' => $id,
                            'part' => $part,
                            'op' => $op,
                        ),
                    ),
                    'm' => array(
                        array(
                            'type' => MemberType::CONTACT()->value(),
                            'value' => $value,
                            'op' => $op,
                        ),
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyContactApi()
    {
        $id = mt_rand(1, 10);
        $name = $this->faker->word;
        $value = $this->faker->word;
        $aid = $this->faker->uuid;
        $part = $this->faker->word;
        $op = $this->faker->randomElement(['+', '-', 'reset']);
        $tn = $this->faker->word;

        $a = new ModifyContactAttr(
            $name, $value, $aid, $id, $part, $op
        );
        $m = new ModifyContactGroupMember(
            MemberType::CONTACT(), $value, $op
        );
        $cn = new ModifyContactSpec(
            $id, $tn, [$a], [$m]
        );

        $this->api->modifyContact(
            $cn, true, true
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyContactRequest replace="true" verbose="true">'
                        .'<urn1:cn id="' . $id . '" tn="' . $tn . '">'
                            .'<urn1:a n="' . $name . '" aid="' . $aid . '" id="' . $id . '" part="' . $part . '" op="' . $op . '">' . $value . '</urn1:a>'
                            .'<urn1:m type="' . MemberType::CONTACT() . '" value="' . $value . '" op="' . $op . '" />'
                        .'</urn1:cn>'
                    .'</urn1:ModifyContactRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
