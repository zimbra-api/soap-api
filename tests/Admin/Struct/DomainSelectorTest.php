<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Common\Enum\DomainBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DomainSelector.
 */
class DomainSelectorTest extends ZimbraTestCase
{
    public function testDomainSelector()
    {
        $value = $this->faker->word;
        $domain = new DomainSelector(DomainBy::ID(), $value);
        $this->assertEquals(DomainBy::ID(), $domain->getBy());
        $this->assertSame($value, $domain->getValue());

        $domain = new DomainSelector(DomainBy::ID());
        $domain->setBy(DomainBy::NAME())
               ->setValue($value);
        $this->assertEquals(DomainBy::NAME(), $domain->getBy());
        $this->assertSame($value, $domain->getValue());

        $by = DomainBy::NAME()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result by="$by">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($domain, 'xml'));
        $this->assertEquals($domain, $this->serializer->deserialize($xml, DomainSelector::class, 'xml'));
    }
}
