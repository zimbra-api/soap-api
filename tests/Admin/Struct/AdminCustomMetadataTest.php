<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\AdminCustomMetadata;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AdminCustomMetadata.
 */
class AdminCustomMetadataTest extends ZimbraTestCase
{
    public function testAdminCustomMetadata()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $section = $this->faker->word;

        $meta = new StubAdminCustomMetadata($section);
        $this->assertSame($section, $meta->getSection());

        $meta = new StubAdminCustomMetadata;
        $meta->setSection($section)
             ->setKeyValuePairs([new KeyValuePair($key, $value)]);
        $this->assertSame($section, $meta->getSection());

        $xml = <<<EOT
<?xml version="1.0"?>
<result section="$section" xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($meta, 'xml'));
        $this->assertEquals($meta, $this->serializer->deserialize($xml, StubAdminCustomMetadata::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubAdminCustomMetadata extends AdminCustomMetadata
{
}
