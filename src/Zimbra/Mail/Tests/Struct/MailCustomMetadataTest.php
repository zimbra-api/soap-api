<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for MailCustomMetadata.
 */
class MailCustomMetadataTest extends ZimbraMailTestCase
{
    public function testMailCustomMetadata()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $section = $this->faker->word;

        $a = new KeyValuePair($key, $value);
        $meta = new MailCustomMetadata($section, [$a]);
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailKeyValuePairs', $meta);
        $this->assertSame($section, $meta->getSection());
        $meta->setSection($section);
        $this->assertSame($section, $meta->getSection());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<meta section="' . $section . '">'
                .'<a n="' . $key . '">' . $value . '</a>'
            .'</meta>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $meta);

        $array = array(
            'meta' => array(
                'a' => array(
                    array('n' => $key, '_content' => $value)
                ),
                'section' => $section,
            ),
        );
        $this->assertEquals($array, $meta->toArray());
    }
}
