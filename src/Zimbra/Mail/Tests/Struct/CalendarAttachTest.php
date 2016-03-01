<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\CalendarAttach;

/**
 * Testcase class for CalendarAttach.
 */
class CalendarAttachTest extends ZimbraMailTestCase
{
    public function testCalendarAttach()
    {
        $uri = $this->faker->word;
        $ct = $this->faker->word;
        $value = $this->faker->word;

        $ca = new CalendarAttach($uri, $ct, $value);
        $this->assertSame($uri, $ca->getUri());
        $this->assertSame($ct, $ca->getContentType());
        $this->assertSame($value, $ca->getValue());

        $ca->setUri($uri)
           ->setContentType($ct)
           ->setValue($value);
        $this->assertSame($uri, $ca->getUri());
        $this->assertSame($ct, $ca->getContentType());
        $this->assertSame($value, $ca->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<attach uri="' . $uri . '" ct="' . $ct . '">' . $value . '</attach>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ca);

        $array = array(
            'attach' => array(
                'uri' => $uri,
                'ct' => $ct,
                '_content' => $value,
            ),
        );
        $this->assertEquals($array, $ca->toArray());
    }
}
