<?php declare(strict_types=1);

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

        $pri = new PrincipalSelector(PrincipalBy::DN(), $value);
        $this->assertEquals(PrincipalBy::DN(), $pri->getBy());
        $this->assertSame($value, $pri->getValue());

        $pri = new PrincipalSelector(PrincipalBy::DN());
        $pri->setBy(PrincipalBy::NAME())
            ->setValue($value);
        $this->assertEquals(PrincipalBy::NAME(), $pri->getBy());
        $this->assertSame($value, $pri->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<principal by="' . PrincipalBy::NAME() . '">' . $value . '</principal>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($pri, 'xml'));
        $this->assertEquals($pri, $this->serializer->deserialize($xml, PrincipalSelector::class, 'xml'));

        $json = json_encode([
            'by' => (string) PrincipalBy::NAME(),
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($pri, 'json'));
        $this->assertEquals($pri, $this->serializer->deserialize($json, PrincipalSelector::class, 'json'));
    }
}
