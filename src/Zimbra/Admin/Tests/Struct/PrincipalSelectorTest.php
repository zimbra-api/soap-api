<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\PrincipalSelector;
use Zimbra\Enum\AutoProvPrincipalBy as PrincipalBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for PrincipalSelector.
 */
class PrincipalSelectorTest extends ZimbraStructTestCase
{
    public function testPrincipalSelector()
    {
        $value = $this->faker->word;

        $pri = new PrincipalSelector(PrincipalBy::DN()->value(), $value);
        $this->assertSame(PrincipalBy::DN()->value(), $pri->getBy());
        $this->assertSame($value, $pri->getValue());

        $pri = new PrincipalSelector('');
        $pri->setBy(PrincipalBy::NAME()->value())
            ->setValue($value);
        $this->assertSame(PrincipalBy::NAME()->value(), $pri->getBy());
        $this->assertSame($value, $pri->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<principal by="' . PrincipalBy::NAME() . '">' . $value . '</principal>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($pri, 'xml'));

        $pri = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\PrincipalSelector', 'xml');
        $this->assertSame(PrincipalBy::NAME()->value(), $pri->getBy());
        $this->assertSame($value, $pri->getValue());
    }
}
