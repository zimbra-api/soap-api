<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\DomainAggregateQuotaInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DomainAggregateQuotaInfo.
 */
class DomainAggregateQuotaInfoTest extends ZimbraStructTestCase
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<domain name="' . $name . '" id="' . $id . '" used="' . $quotaUsed . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($domain, 'xml'));
        $this->assertEquals($domain, $this->serializer->deserialize($xml, DomainAggregateQuotaInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
            'used' => $quotaUsed,
        ]);
        $this->assertSame($json, $this->serializer->serialize($domain, 'json'));
        $this->assertEquals($domain, $this->serializer->deserialize($json, DomainAggregateQuotaInfo::class, 'json'));
    }
}
