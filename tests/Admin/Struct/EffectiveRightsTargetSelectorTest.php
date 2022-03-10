<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\EffectiveRightsTargetSelector;
use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EffectiveRightsTargetSelector.
 */
class EffectiveRightsTargetSelectorTest extends ZimbraTestCase
{
    public function testEffectiveRightsTargetSelector()
    {
        $value = $this->faker->word;
        $target = new EffectiveRightsTargetSelector(
            TargetType::DOMAIN(), TargetBy::ID(), $value
        );
        $this->assertEquals(TargetType::DOMAIN(), $target->getType());
        $this->assertEquals(TargetBy::ID(), $target->getBy());
        $this->assertSame($value, $target->getValue());

        $target = new EffectiveRightsTargetSelector(TargetType::DOMAIN(), TargetBy::ID());
        $target->setType(TargetType::ACCOUNT())
               ->setBy(TargetBy::NAME())
               ->setValue($value);
        $this->assertEquals(TargetType::ACCOUNT(), $target->getType());
        $this->assertEquals(TargetBy::NAME(), $target->getBy());
        $this->assertSame($value, $target->getValue());

        $type = TargetType::ACCOUNT()->getValue();
        $by = TargetBy::NAME()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type" by="$by">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, EffectiveRightsTargetSelector::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            'by' => $by,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($target, 'json'));
        $this->assertEquals($target, $this->serializer->deserialize($json, EffectiveRightsTargetSelector::class, 'json'));
    }
}
