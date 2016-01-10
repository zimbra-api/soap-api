<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\TagSpec;

/**
 * Testcase class for TagSpec.
 */
class TagSpecTest extends ZimbraMailTestCase
{
    public function testTagSpec()
    {
        $name = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $color = mt_rand(1, 127);
        $tag = new TagSpec(
            $name, $rgb, $color
        );
        $this->assertSame($name, $tag->getName());
        $this->assertSame($rgb, $tag->getRgb());
        $this->assertSame($color, $tag->getColor());

        $tag = new TagSpec('');
        $tag->setName($name)
            ->setRgb($rgb)
            ->setColor($color);
        $this->assertSame($name, $tag->getName());
        $this->assertSame($rgb, $tag->getRgb());
        $this->assertSame($color, $tag->getColor());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<tag name="' . $name . '" rgb="' . $rgb . '" color="' . $color . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $tag);

        $array = array(
            'tag' => array(
                'name' => $name,
                'rgb' => $rgb,
                'color' => $color,
            ),
        );
        $this->assertEquals($array, $tag->toArray());
    }
}
