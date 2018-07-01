<?php

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
        $cos = new CosSelector(CosBy::ID()->value(), $value);
        $this->assertSame(CosBy::ID()->value(), $cos->getBy());
        $this->assertSame($value, $cos->getValue());

        $cos = new CosSelector('');
        $cos->setBy(CosBy::NAME()->value())
            ->setValue($value);
        $this->assertSame(CosBy::NAME()->value(), $cos->getBy());
        $this->assertSame($value, $cos->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cos, 'xml'));

        $cos = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\CosSelector', 'xml');
        $this->assertSame(CosBy::NAME()->value(), $cos->getBy());
        $this->assertSame($value, $cos->getValue());
    }
}
