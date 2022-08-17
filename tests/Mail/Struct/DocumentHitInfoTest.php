<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\DocumentHitInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DocumentHitInfo.
 */
class DocumentHitInfoTest extends ZimbraTestCase
{
    public function testDocumentHitInfo()
    {
        $id = $this->faker->uuid;
        $sortField = $this->faker->word;

        $hit = new DocumentHitInfo($id, $sortField);
        $this->assertSame($sortField, $hit->getSortField());
        $hit = new DocumentHitInfo($id);
        $hit->setSortField($sortField);
        $this->assertSame($sortField, $hit->getSortField());

        $xml = <<<EOT
<?xml version="1.0"?>
<result sf="$sortField" id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($hit, 'xml'));
        $this->assertEquals($hit, $this->serializer->deserialize($xml, DocumentHitInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubDocumentHitInfo extends DocumentHitInfo
{
}
