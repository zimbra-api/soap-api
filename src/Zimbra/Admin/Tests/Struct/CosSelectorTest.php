<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Enum\CosBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CosSelector.
 */
class CosSelectorTest extends ZimbraStructTestCase
{
    public function testCosSelector()
    {
        $value = $this->faker->word;
        $cos = new CosSelector(CosBy::ID(), $value);
        $this->assertEquals(CosBy::ID(), $cos->getBy());
        $this->assertSame($value, $cos->getValue());

        $cos = new CosSelector(CosBy::ID());
        $cos->setBy(CosBy::NAME())
            ->setValue($value);
        $this->assertEquals(CosBy::NAME(), $cos->getBy());
        $this->assertSame($value, $cos->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cos, 'xml'));
        $this->assertEquals($cos, $this->serializer->deserialize($xml, CosSelector::class, 'xml'));

        $json = json_encode([
            'by' => (string) CosBy::NAME(),
            '_content' => $value,
        ]);
        $this->assertSame($json, $this->serializer->serialize($cos, 'json'));
        $this->assertEquals($cos, $this->serializer->deserialize($json, CosSelector::class, 'json'));
    }
}
