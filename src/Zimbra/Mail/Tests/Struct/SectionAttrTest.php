<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\SectionAttr;

/**
 * Testcase class for SectionAttr.
 */
class SectionAttrTest extends ZimbraMailTestCase
{
    public function testSectionAttr()
    {
        $section = $this->faker->word;
        $attr = new SectionAttr($section);
        $this->assertSame($section, $attr->getSection());

        $attr = new SectionAttr('');
        $attr->setSection($section);
        $this->assertSame($section, $attr->getSection());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<attr section="' . $section . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = array(
            'attr' => array(
                'section' => $section,
            ),
        );
        $this->assertEquals($array, $attr->toArray());
    }
}
