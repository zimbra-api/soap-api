<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Account\Struct\AccountCustomMetadata;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountCustomMetadata.
 */
class AccountCustomMetadataTest extends ZimbraTestCase
{
    public function testAccountCustomMetadata()
    {
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $meta = new MockAccountCustomMetadata($section);
        $this->assertSame($section, $meta->getSection());

        $meta = new MockAccountCustomMetadata;
        $meta->setSection($section)
             ->setKeyValuePairs([new KeyValuePair($key, $value)]);
        $this->assertSame($section, $meta->getSection());

        $xml = <<<EOT
<?xml version="1.0"?>
<result section="$section" xmlns:urn="urn:zimbraAccount">
    <urn:a n="$key">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($meta, 'xml'));
        $this->assertEquals($meta, $this->serializer->deserialize($xml, MockAccountCustomMetadata::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAccount", prefix="urn")
 */
class MockAccountCustomMetadata extends AccountCustomMetadata
{
}
