<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\Right;

/**
 * Testcase class for Right.
 */
class RightTest extends ZimbraMailTestCase
{
    public function testRight()
    {
        $right = $this->faker->word;
        $ace = new Right($right);
        $this->assertSame($right, $ace->getRight());

        $ace = new Right('');
        $ace->setRight($right);
        $this->assertSame($right, $ace->getRight());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<ace right="' . $right . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ace);

        $array = array(
            'ace' => array(
                'right' => $right,
            ),
        );
        $this->assertEquals($array, $ace->toArray());
    }
}
