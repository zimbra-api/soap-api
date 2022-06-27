<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\TagSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TagSpec.
 */
class TagSpecTest extends ZimbraTestCase
{
    public function testTagSpec()
    {
        $name = $this->faker->uuid;
        $rgb = $this->faker->hexcolor;
        $color = $this->faker->numberBetween(0, 127);

        $tag = new TagSpec(
            $name,
            $rgb,
            $color
        );
        $this->assertSame($name, $tag->getName());
        $this->assertSame($rgb, $tag->getRgb());
        $this->assertSame($color, $tag->getColor());

        $tag = new TagSpec('');
        $tag->setName($name)
            ->setColor($color)
            ->setRgb($rgb);
        $this->assertSame($name, $tag->getName());
        $this->assertSame($rgb, $tag->getRgb());
        $this->assertSame($color, $tag->getColor());
 
        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" rgb="$rgb" color="$color" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($tag, 'xml'));
        $this->assertEquals($tag, $this->serializer->deserialize($xml, TagSpec::class, 'xml'));
    }
}
