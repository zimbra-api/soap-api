<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ContactSpec;
use Zimbra\Mail\Struct\NewContactAttr;
use Zimbra\Mail\Struct\NewContactGroupMember;
use Zimbra\Mail\Struct\VCardInfo;

/**
 * Testcase class for ContactSpec.
 */
class ContactSpecTest extends ZimbraMailTestCase
{
    public function testContactSpec()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $mid = $this->faker->word;
        $part = $this->faker->word;
        $aid = $this->faker->uuid;
        $type = $this->faker->word;
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

        $folder = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;

        $cn = new ContactSpec(
            $id, $folder, $tags, $tagNames, $vcard, [$attr], [$member]
        );
        $this->assertSame($vcard, $cn->getVCard());
        $this->assertSame([$attr], $cn->getAttrs()->all());
        $this->assertSame([$member], $cn->getGroupMembers()->all());
        $this->assertSame($id, $cn->getId());
        $this->assertSame($folder, $cn->getFolder());
        $this->assertSame($tags, $cn->getTags());
        $this->assertSame($tagNames, $cn->getTagNames());

        $cn->setVCard($vcard)
           ->addAttr($attr)
           ->addGroupMember($member)
           ->setId($id)
           ->setFolder($folder)
           ->setTags($tags)
           ->setTagNames($tagNames);
        $this->assertSame($vcard, $cn->getVCard());
        $this->assertSame([$attr, $attr], $cn->getAttrs()->all());
        $this->assertSame([$member, $member], $cn->getGroupMembers()->all());
        $this->assertSame($id, $cn->getId());
        $this->assertSame($folder, $cn->getFolder());
        $this->assertSame($tags, $cn->getTags());
        $this->assertSame($tagNames, $cn->getTagNames());

        $cn = new ContactSpec(
            $id, $folder, $tags, $tagNames, $vcard, [$attr], [$member]
        );

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<cn id="' . $id . '" l="' . $folder . '" t="' . $tags . '" tn="' . $tagNames . '">'
                .'<vcard mid="' . $mid . '" part="' . $part . '" aid="' . $aid . '">' . $value . '</vcard>'
                .'<a n="' . $name . '" aid="' . $aid . '" id="' . $id . '" part="' . $part . '">' . $value . '</a>'
                .'<m type="' . $type . '" value="' . $value . '" />'
            .'</cn>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cn);

        $array = array(
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
        );
        $this->assertEquals($array, $cn->toArray());
    }
}
