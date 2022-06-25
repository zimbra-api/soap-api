<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\CookieSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CookieSpec.
 */
class CookieSpecTest extends ZimbraTestCase
{
    public function testCookieSpec()
    {
        $name = $this->faker->word;
        $cookie = new CookieSpec($name);
        $this->assertSame($name, $cookie->getName());

        $cookie = new CookieSpec('');
        $cookie->setName($name);
        $this->assertSame($name, $cookie->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cookie, 'xml'));
        $this->assertEquals($cookie, $this->serializer->deserialize($xml, CookieSpec::class, 'xml'));
    }
}
