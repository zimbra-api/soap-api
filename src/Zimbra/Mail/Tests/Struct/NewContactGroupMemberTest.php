<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\NewContactGroupMember;

/**
 * Testcase class for NewContactGroupMember.
 */
class NewContactGroupMemberTest extends ZimbraMailTestCase
{
    public function testNewContactGroupMember()
    {
        $type = $this->faker->word;
        $value = $this->faker->word;
        $m = new NewContactGroupMember(
            $type, $value
        );
        $this->assertSame($type, $m->getType());
        $this->assertSame($value, $m->getValue());

        $m = new NewContactGroupMember('', '');
        $m->setType($type)
          ->setValue($value);
        $this->assertSame($type, $m->getType());
        $this->assertSame($value, $m->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<m type="' . $type . '" value="' . $value . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'type' => $type,
                'value' => $value,
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }
}
