<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\CookieSpec;

/**
 * Testcase class for CookieSpec.
 */
class CookieSpecTest extends ZimbraAdminTestCase
{
    public function testCookieSpec()
    {
        $name = $this->faker->word;
        $cookie = new CookieSpec($name);
        $this->assertSame($name, $cookie->getName());

        $cookie->setName($name);
        $this->assertSame($name, $cookie->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<cookie name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cookie);

        $array = [
            'cookie' => [
                'name' => $name,
            ],
        ];
        $this->assertEquals($array, $cookie->toArray());
    }
}
