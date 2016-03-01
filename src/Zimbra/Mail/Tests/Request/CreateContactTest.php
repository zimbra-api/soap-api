<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\CreateContact;
use Zimbra\Mail\Struct\ContactSpec;
use Zimbra\Mail\Struct\NewContactAttr;
use Zimbra\Mail\Struct\NewContactGroupMember;
use Zimbra\Mail\Struct\VCardInfo;

/**
 * Testcase class for CreateContact.
 */
class CreateContactTest extends ZimbraMailApiTestCase
{
    public function testCreateContactRequest()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $mid = $this->faker->word;
        $part = $this->faker->word;
        $aid = $this->faker->uuid;
        $type = $this->faker->word;
        $folder = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $id = mt_rand(1, 10);
        $vcard = new VCardInfo(
            $value, $mid, $part, $aid
        );
        $attr = new NewContactAttr(
            $name, $value, $aid, $id, $part
        );
        $member = new NewContactGroupMember(
            $type, $value
        );
        $cn = new ContactSpec(
            $id, $folder, $tags, $tagNames, $vcard, [$attr], [$member]
        );

        $req = new CreateContact(
            $cn, true
        );
        $this->assertSame($cn, $req->getContact());
        $this->assertTrue($req->getVerbose());

        $req->setContact($cn)
            ->setVerbose(true);
        $this->assertSame($cn, $req->getContact());
        $this->assertTrue($req->getVerbose());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateContactRequest verbose="true">'
            .'<cn id="' . $id . '" l="' . $folder . '" t="' . $tags . '" tn="' . $tagNames . '">'
                .'<vcard mid="' . $mid . '" part="' . $part . '" aid="' . $aid . '">' . $value . '</vcard>'
                .'<a n="' . $name . '" aid="' . $aid . '" id="' . $id . '" part="' . $part . '">' . $value . '</a>'
                .'<m type="' . $type . '" value="' . $value . '" />'
            .'</cn>'
            .'</CreateContactRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateContactRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'verbose' => true,
                'cn' => array(
                    'id' => $id,
                    'l' => $folder,
                    't' => $tags,
                    'tn' => $tagNames,
                    'vcard' => array(
                        '_content' => $value,
                        'mid' => $mid,
                        'part' => $part,
                        'aid' => $aid,
                    ),
                    'a' => array(
                        array(
                            'n' => $name,
                            '_content' => $value,
                            'aid' => $aid,
                            'id' => $id,
                            'part' => $part,
                        ),
                    ),
                    'm' => array(
                        array(
                            'type' => $type,
                            'value' => $value,
                        ),
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateContactApi()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $mid = $this->faker->word;
        $part = $this->faker->word;
        $aid = $this->faker->uuid;
        $type = $this->faker->word;
        $folder = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $id = mt_rand(1, 10);
        $vcard = new VCardInfo(
            $value, $mid, $part, $aid
        );
        $attr = new NewContactAttr(
            $name, $value, $aid, $id, $part
        );
        $member = new NewContactGroupMember(
            $type, $value
        );
        $cn = new ContactSpec(
            $id, $folder, $tags, $tagNames, $vcard, [$attr], [$member]
        );

        $this->api->createContact(
           $cn, true
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateContactRequest verbose="true">'
                        .'<urn1:cn id="' . $id . '" l="' . $folder . '" t="' . $tags . '" tn="' . $tagNames . '">'
                            .'<urn1:vcard mid="' . $mid . '" part="' . $part . '" aid="' . $aid . '">' . $value . '</urn1:vcard>'
                            .'<urn1:a n="' . $name . '" aid="' . $aid . '" id="' . $id . '" part="' . $part . '">' . $value . '</urn1:a>'
                            .'<urn1:m type="' . $type . '" value="' . $value . '" />'
                        .'</urn1:cn>'
                    .'</urn1:CreateContactRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
