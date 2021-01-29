<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\AccountCustomMetadata;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for AccountCustomMetadata.
 */
class AccountCustomMetadataTest extends ZimbraStructTestCase
{
    public function testAccountCustomMetadata()
    {
        $section = $this->faker->word;
        $meta = new AccountCustomMetadata($section);
        $this->assertSame($section, $meta->getSection());

        $meta = new AccountCustomMetadata;
        $meta->setSection($section);
        $this->assertSame($section, $meta->getSection());

        $xml = <<<EOT
<?xml version="1.0"?>
<meta section="$section" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($meta, 'xml'));
        $this->assertEquals($meta, $this->serializer->deserialize($xml, AccountCustomMetadata::class, 'xml'));

        $json = json_encode([
            'section' => $section,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($meta, 'json'));
        $this->assertEquals($meta, $this->serializer->deserialize($json, AccountCustomMetadata::class, 'json'));
    }
}
