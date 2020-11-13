<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\CookieSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CookieSpec.
 */
class CookieSpecTest extends ZimbraStructTestCase
{
    public function testCookieSpec()
    {
        $name = $this->faker->word;
        $cookie = new CookieSpec($name);
        $this->assertSame($name, $cookie->getName());

        $cookie = new CookieSpec('');
        $cookie->setName($name);
        $this->assertSame($name, $cookie->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<cookie name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cookie, 'xml'));
        $this->assertEquals($cookie, $this->serializer->deserialize($xml, CookieSpec::class, 'xml'));

        $json = json_encode([
            'name' => $name,
        ]);
        $this->assertSame($json, $this->serializer->serialize($cookie, 'json'));
        $this->assertEquals($cookie, $this->serializer->deserialize($json, CookieSpec::class, 'json'));
    }
}
