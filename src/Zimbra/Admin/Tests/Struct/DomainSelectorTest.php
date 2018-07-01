<?php

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
        $domain = new DomainSelector(DomainBy::ID()->value(), $value);
        $this->assertSame(DomainBy::ID()->value(), $domain->getBy());
        $this->assertSame($value, $domain->getValue());

        $domain = new DomainSelector('');
        $domain->setBy(DomainBy::NAME()->value())
               ->setValue($value);
        $this->assertSame(DomainBy::NAME()->value(), $domain->getBy());
        $this->assertSame($value, $domain->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($domain, 'xml'));

        $domain = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\DomainSelector', 'xml');
        $this->assertSame(DomainBy::NAME()->value(), $domain->getBy());
        $this->assertSame($value, $domain->getValue());
    }
}
