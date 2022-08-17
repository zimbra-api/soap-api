<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\EffectiveAttrInfo;
use Zimbra\Admin\Struct\EffectiveAttrsInfo;
use Zimbra\Admin\Struct\EffectiveRightsInfo;
use Zimbra\Admin\Struct\RightsEntriesInfo;
use Zimbra\Admin\Struct\RightWithName;
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RightsEntriesInfo.
 */
class RightsEntriesInfoTest extends ZimbraTestCase
{
    public function testRightsEntriesInfo()
    {
        $name = $this->faker->word;
        $value1= $this->faker->unique()->word;
        $value2= $this->faker->unique()->word;
        $max= $this->faker->word;
        $min= $this->faker->word;

        $right = new RightWithName($name);
        $constraint = new ConstraintInfo($min, $max, [$value1, $value2]);
        $attr = new EffectiveAttrInfo($name, $constraint, [$value1, $value2]);
        $setAttrs = new EffectiveAttrsInfo(TRUE, [$attr]);
        $getAttrs = new EffectiveAttrsInfo(FALSE, [$attr]);

        $rights = new EffectiveRightsInfo($setAttrs, $getAttrs, [$right]);
        $entry = new NamedElement($name);

        $entries = new StubRightsEntriesInfo($rights, [$entry]);
        $this->assertSame($rights, $entries->getRights());
        $this->assertSame([$entry], $entries->getEntries());

        $entries = new StubRightsEntriesInfo(new EffectiveRightsInfo($setAttrs, $getAttrs));
        $entries->setRights($rights)
            ->setEntries([$entry])
            ->addEntry($entry);
        $this->assertSame($rights, $entries->getRights());
        $this->assertSame([$entry, $entry], $entries->getEntries());
        $entries = new StubRightsEntriesInfo($rights, [$entry]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:entry name="$name" />
    <urn:rights>
        <urn:right n="$name" />
        <urn:setAttrs all="true">
            <urn:a n="$name">
                <urn:constraint>
                    <urn:min>$min</urn:min>
                    <urn:max>$max</urn:max>
                    <urn:values>
                        <urn:v>$value1</urn:v>
                        <urn:v>$value2</urn:v>
                    </urn:values>
                </urn:constraint>
                <urn:default>
                    <urn:v>$value1</urn:v>
                    <urn:v>$value2</urn:v>
                </urn:default>
            </urn:a>
        </urn:setAttrs>
        <urn:getAttrs all="false">
            <urn:a n="$name">
                <urn:constraint>
                    <urn:min>$min</urn:min>
                    <urn:max>$max</urn:max>
                    <urn:values>
                        <urn:v>$value1</urn:v>
                        <urn:v>$value2</urn:v>
                    </urn:values>
                </urn:constraint>
                <urn:default>
                    <urn:v>$value1</urn:v>
                    <urn:v>$value2</urn:v>
                </urn:default>
            </urn:a>
        </urn:getAttrs>
    </urn:rights>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($entries, 'xml'));
        $this->assertEquals($entries, $this->serializer->deserialize($xml, StubRightsEntriesInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubRightsEntriesInfo extends RightsEntriesInfo
{
}
