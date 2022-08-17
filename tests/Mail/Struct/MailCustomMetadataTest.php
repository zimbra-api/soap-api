<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailCustomMetadata.
 */
class MailCustomMetadataTest extends ZimbraTestCase
{
    public function testMailCustomMetadata()
    {
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $meta = new StubMailCustomMetadata($section);
        $this->assertSame($section, $meta->getSection());

        $meta = new StubMailCustomMetadata;
        $meta->setSection($section)
             ->setKeyValuePairs([new KeyValuePair($key, $value)]);
        $this->assertSame($section, $meta->getSection());

        $xml = <<<EOT
<?xml version="1.0"?>
<result section="$section" xmlns:urn="urn:zimbraMail">
    <urn:a n="$key">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($meta, 'xml'));
        $this->assertEquals($meta, $this->serializer->deserialize($xml, StubMailCustomMetadata::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubMailCustomMetadata extends MailCustomMetadata
{
}
