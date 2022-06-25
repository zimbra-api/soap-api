<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\NewContactAttr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NewContactAttr.
 */
class NewContactAttrTest extends ZimbraTestCase
{
    public function testNewContactAttr()
    {
        $name = $this->faker->word;
        $attachId = $this->faker->uuid;
        $id = $this->faker->numberBetween(1, 100);
        $part = $this->faker->word;
        $value = $this->faker->word;

        $attr = new NewContactAttr(
            $name, $attachId, $id, $part, $value
        );
        $this->assertSame($name, $attr->getName());
        $this->assertSame($attachId, $attr->getAttachId());
        $this->assertSame($id, $attr->getId());
        $this->assertSame($part, $attr->getPart());
        $this->assertSame($value, $attr->getValue());

        $attr = new NewContactAttr('');
        $attr->setName($name)
            ->setAttachId($attachId)
            ->setId($id)
            ->setPart($part)
            ->setValue($value);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($attachId, $attr->getAttachId());
        $this->assertSame($id, $attr->getId());
        $this->assertSame($part, $attr->getPart());
        $this->assertSame($value, $attr->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result n="$name" aid="$attachId" id="$id" part="$part">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, NewContactAttr::class, 'xml'));

        $json = json_encode([
            'n' => $name,
            'aid' => $attachId,
            'id' => $id,
            'part' => $part,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attr, 'json'));
        $this->assertEquals($attr, $this->serializer->deserialize($json, NewContactAttr::class, 'json'));
    }
}
