<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\Part;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Part.
 */
class PartTest extends ZimbraTestCase
{
    public function testPart()
    {
        $part = $this->faker->word;

        $hp = new Part($part);
        $this->assertSame($part, $hp->getPart());

        $hp = new Part();
        $hp->setPart($part);
        $this->assertSame($part, $hp->getPart());

        $xml = <<<EOT
<?xml version="1.0"?>
<result part="$part" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($hp, 'xml'));
        $this->assertEquals($hp, $this->serializer->deserialize($xml, Part::class, 'xml'));
    }
}
