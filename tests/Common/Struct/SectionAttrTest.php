<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use Zimbra\Common\Struct\SectionAttr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SectionAttr.
 */
class SectionAttrTest extends ZimbraTestCase
{
    public function testSectionAttr()
    {
        $section = $this->faker->word;

        $attr = new SectionAttr($section);
        $this->assertSame($section, $attr->getSection());

        $attr = new SectionAttr('');
        $attr->setSection($section);
        $this->assertSame($section, $attr->getSection());

        $xml = <<<EOT
<?xml version="1.0"?>
<result section="$section" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, SectionAttr::class, 'xml'));
    }
}
