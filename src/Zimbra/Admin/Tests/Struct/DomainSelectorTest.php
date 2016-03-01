<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Enum\DomainBy;

/**
 * Testcase class for DomainSelector.
 */
class DomainSelectorTest extends ZimbraAdminTestCase
{
    public function testDomainSelector()
    {
        $value = $this->faker->word;
        $domain = new DomainSelector(DomainBy::ID(), $value);
        $this->assertTrue($domain->getBy()->is('id'));
        $this->assertSame($value, $domain->getValue());

        $domain->setBy(DomainBy::NAME());
        $this->assertTrue($domain->getBy()->is('name'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $domain);

        $array = [
            'domain' => [
                'by' => DomainBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $domain->toArray());
    }
}
