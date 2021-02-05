<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Enum\CosBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CosSelector.
 */
class CosSelectorTest extends ZimbraTestCase
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

        $by = CosBy::NAME()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<cos by="$by">$value</cos>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($cos, 'xml'));
        $this->assertEquals($cos, $this->serializer->deserialize($xml, CosSelector::class, 'xml'));

        $json = json_encode([
            'by' => $by,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($cos, 'json'));
        $this->assertEquals($cos, $this->serializer->deserialize($json, CosSelector::class, 'json'));
    }
}