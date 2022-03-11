<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\Header;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Header.
 */
class HeaderTest extends ZimbraTestCase
{
    public function testHeader()
    {
        $name = $this->faker->name;
        $value = $this->faker->word;

        $header = new Header($name, $value);
        $this->assertSame($name, $header->getName());
        $this->assertSame($value, $header->getValue());

        $header = new Header();
        $header->setName($name)
            ->setValue($value);
        $this->assertSame($name, $header->getName());
        $this->assertSame($value, $header->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($header, 'xml'));
        $this->assertEquals($header, $this->serializer->deserialize($xml, Header::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($header, 'json'));
        $this->assertEquals($header, $this->serializer->deserialize($json, Header::class, 'json'));
    }
}
