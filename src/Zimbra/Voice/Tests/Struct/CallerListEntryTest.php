<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Voice\Struct\CallerListEntry;

/**
 * Testcase class for CallerListEntry.
 */
class CallerListEntryTest extends ZimbraStructTestCase
{
    public function testCallerListEntry()
    {
        $pn = $this->faker->word;
        $phone = new CallerListEntry($pn, true);
        $this->assertSame($pn, $phone->getPhoneNumber());
        $this->assertTrue($phone->getActive());
        $phone->setPhoneNumber($pn)
              ->setActive(true);
        $this->assertSame($pn, $phone->getPhoneNumber());
        $this->assertTrue($phone->getActive());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone pn="' . $pn . '" a="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = [
            'phone' => [
                'pn' => $pn,
                'a' => true,
            ],
        ];
        $this->assertEquals($array, $phone->toArray());
    }
}
