<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\WikiHitInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for WikiHitInfo.
 */
class WikiHitInfoTest extends ZimbraTestCase
{
    public function testWikiHitInfo()
    {
        $id = $this->faker->uuid;
        $sortField = $this->faker->word;

        $hit = new WikiHitInfo($id, $sortField);
        $this->assertSame($sortField, $hit->getSortField());
        $hit = new WikiHitInfo($id);
        $hit->setSortField($sortField);
        $this->assertSame($sortField, $hit->getSortField());

        $xml = <<<EOT
<?xml version="1.0"?>
<result sf="$sortField" id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($hit, 'xml'));
        $this->assertEquals($hit, $this->serializer->deserialize($xml, WikiHitInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubWikiHitInfo extends WikiHitInfo
{
}
