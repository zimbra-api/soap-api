<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\VCardInfo;

/**
 * Testcase class for VCardInfo.
 */
class VCardInfoTest extends ZimbraMailTestCase
{
    public function testVCardInfo()
    {
        $value = $this->faker->word;
        $mid = $this->faker->uuid;
        $part = $this->faker->word;
        $aid = $this->faker->uuid;

        $vcard = new VCardInfo(
            $value, $mid, $part, $aid
        );
        $this->assertSame($mid, $vcard->getMessageId());
        $this->assertSame($part, $vcard->getPart());
        $this->assertSame($aid, $vcard->getAttachId());

        $vcard = new VCardInfo($value);
        $vcard->setMessageId($mid)
              ->setPart($part)
              ->setAttachId($aid);
        $this->assertSame($mid, $vcard->getMessageId());
        $this->assertSame($part, $vcard->getPart());
        $this->assertSame($aid, $vcard->getAttachId());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<vcard mid="' . $mid . '" part="' . $part . '" aid="' . $aid . '">' . $value . '</vcard>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $vcard);

        $array = array(
            'vcard' => array(
                '_content' => $value,
                'mid' => $mid,
                'part' => $part,
                'aid' => $aid,
            ),
        );
        $this->assertEquals($array, $vcard->toArray());
    }
}
