<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Enum\DomainBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DomainSelector.
 */
class DomainSelectorTest extends ZimbraStructTestCase
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($domain, 'xml'));
        $this->assertEquals($domain, $this->serializer->deserialize($xml, DomainSelector::class, 'xml'));

        $json = json_encode([
            'by' => (string) DomainBy::NAME(),
            '_content' => $value,
        ]);
        $this->assertSame($json, $this->serializer->serialize($domain, 'json'));
        $this->assertEquals($domain, $this->serializer->deserialize($json, DomainSelector::class, 'json'));
    }
}
