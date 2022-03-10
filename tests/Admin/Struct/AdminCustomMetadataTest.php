<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AdminCustomMetadata;
use Zimbra\Struct\KeyValuePair;
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

        $meta = new AdminCustomMetadata($section);
        $this->assertSame($section, $meta->getSection());

        $meta = new AdminCustomMetadata;
        $meta->setSection($section)
             ->setKeyValuePairs([new KeyValuePair($key, $value)]);
        $this->assertSame($section, $meta->getSection());

        $xml = <<<EOT
<?xml version="1.0"?>
<result section="$section">
    <a n="$key">$value</a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($meta, 'xml'));
        $this->assertEquals($meta, $this->serializer->deserialize($xml, AdminCustomMetadata::class, 'xml'));

        $json = json_encode([
            'section' => $section,
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($meta, 'json'));
        $this->assertEquals($meta, $this->serializer->deserialize($json, AdminCustomMetadata::class, 'json'));
    }
}
