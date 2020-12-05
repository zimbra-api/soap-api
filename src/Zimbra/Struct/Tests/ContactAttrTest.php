<?php declare(strict_types=1);

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\ContactAttr;

/**
 * Testcase class for ContactAttr.
 */
class ContactAttrTest extends ZimbraStructTestCase
{
    public function testContactAttr()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;

        $part = $this->faker->word;
        $contentType = $this->faker->word;
        $size = mt_rand(1, 99);
        $contentFilename = $this->faker->word;

        $attr = new ContactAttr($key, $value, $part, $contentType, $size, $contentFilename);
        $this->assertSame($part, $attr->getPart());
        $this->assertSame($contentType, $attr->getContentType());
        $this->assertSame($size, $attr->getSize());
        $this->assertSame($contentFilename, $attr->getContentFilename());

        $attr = new ContactAttr($key, $value);
        $attr->setPart($part)
            ->setContentType($contentType)
            ->setSize($size)
            ->setContentFilename($contentFilename);
        $this->assertSame($part, $attr->getPart());
        $this->assertSame($contentType, $attr->getContentType());
        $this->assertSame($size, $attr->getSize());
        $this->assertSame($contentFilename, $attr->getContentFilename());

        $xml = <<<EOT
<?xml version="1.0"?>
<a n="$key" part="$part" ct="$contentType" s="$size" filename="$contentFilename">$value</a>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, ContactAttr::class, 'xml'));

        $json = json_encode([
            'n' => $key,
            '_content' => $value,
            'part' => $part,
            'ct' => $contentType,
            's' => $size,
            'filename' => $contentFilename,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attr, 'json'));
        $this->assertEquals($attr, $this->serializer->deserialize($json, ContactAttr::class, 'json'));
    }
}
