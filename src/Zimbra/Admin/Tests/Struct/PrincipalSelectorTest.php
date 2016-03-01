<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\PrincipalSelector;
use Zimbra\Enum\AutoProvPrincipalBy as PrincipalBy;

/**
 * Testcase class for PrincipalSelector.
 */
class PrincipalSelectorTest extends ZimbraAdminTestCase
{
    public function testPrincipalSelector()
    {
        $value = $this->faker->word;

        $pri = new PrincipalSelector(PrincipalBy::DN(), $value);
        $this->assertSame('dn', $pri->getBy()->value());
        $this->assertSame($value, $pri->getValue());

        $pri->setBy(PrincipalBy::NAME());
        $this->assertSame('name', $pri->getBy()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<principal by="' . PrincipalBy::NAME() . '">' . $value . '</principal>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pri);

        $array = [
            'principal' => [
                'by' => PrincipalBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $pri->toArray());
    }
}
