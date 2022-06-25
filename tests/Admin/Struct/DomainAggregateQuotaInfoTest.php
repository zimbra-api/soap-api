<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\DomainAggregateQuotaInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DomainAggregateQuotaInfo.
 */
class DomainAggregateQuotaInfoTest extends ZimbraTestCase
{
    public function testDomainAggregateQuotaInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $quotaUsed = mt_rand(1, 100);
        $domain = new DomainAggregateQuotaInfo($name, $id, $quotaUsed);
        $this->assertSame($name, $domain->getName());
        $this->assertSame($id, $domain->getId());
        $this->assertSame($quotaUsed, $domain->getQuotaUsed());

        $domain = new DomainAggregateQuotaInfo('', '', 0);
        $domain->setName($name)
               ->setId($id)
               ->setQuotaUsed($quotaUsed);
        $this->assertSame($name, $domain->getName());
        $this->assertSame($id, $domain->getId());
        $this->assertSame($quotaUsed, $domain->getQuotaUsed());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" used="$quotaUsed" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($domain, 'xml'));
        $this->assertEquals($domain, $this->serializer->deserialize($xml, DomainAggregateQuotaInfo::class, 'xml'));
    }
}
