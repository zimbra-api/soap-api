<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\EffectiveAttrInfo;
use Zimbra\Admin\Struct\EffectiveAttrsInfo;
use Zimbra\Admin\Struct\EffectiveRightsInfo;
use Zimbra\Admin\Struct\EffectiveRightsTarget;
use Zimbra\Admin\Struct\InDomainInfo;
use Zimbra\Admin\Struct\RightWithName;
use Zimbra\Admin\Struct\RightsEntriesInfo;
use Zimbra\Common\Enum\TargetType;
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EffectiveRightsTarget.
 */
class EffectiveRightsTargetTest extends ZimbraTestCase
{
    public function testEffectiveRightsTarget()
    {
        $name = $this->faker->word;
        $value1= $this->faker->text;
        $value2= $this->faker->text;
        $min= $this->faker->word;
        $max= $this->faker->word;

        $right = new RightWithName($name);
        $constraint = new ConstraintInfo($min, $max, [$value1, $value2]);
        $attr = new EffectiveAttrInfo($name, $constraint, [$value1, $value2]);
        $setAttrs = new EffectiveAttrsInfo(TRUE, [$attr]);
        $getAttrs = new EffectiveAttrsInfo(FALSE, [$attr]);
        $rights = new EffectiveRightsInfo($setAttrs, $getAttrs, [$right]);

        $domain = new NamedElement($name);
        $entry = new NamedElement($name);
        $inDomains = new InDomainInfo($rights, [$domain]);
        $entries = new RightsEntriesInfo($rights, [$entry]);

        $target = new StubEffectiveRightsTarget(TargetType::ACCOUNT(), $rights, [$inDomains], [$entries]);
        $this->assertEquals(TargetType::ACCOUNT(), $target->getType());
        $this->assertSame($rights, $target->getAll());
        $this->assertSame([$inDomains], $target->getInDomainLists());
        $this->assertSame([$entries], $target->getEntriesLists());

        $target = new StubEffectiveRightsTarget();
        $target->setType(TargetType::DOMAIN())
            ->setAll($rights)
            ->setInDomainLists([$inDomains])
            ->addInDomainList($inDomains)
            ->setEntriesLists([$entries])
            ->addEntriesList($entries);
        $this->assertEquals(TargetType::DOMAIN(), $target->getType());
        $this->assertSame($rights, $target->getAll());
        $this->assertSame([$inDomains, $inDomains], $target->getInDomainLists());
        $this->assertSame([$entries, $entries], $target->getEntriesLists());
        $target = new StubEffectiveRightsTarget(TargetType::ACCOUNT(), $rights, [$inDomains], [$entries]);

        $type = TargetType::ACCOUNT()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type" xmlns:urn="urn:zimbraAdmin">
    <urn:all>
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
    </urn:all>
    <urn:inDomains>
        <urn:domain name="$name" />
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
    </urn:inDomains>
    <urn:entries>
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
                        </values>
                    </urn:constraint>
                    <urn:default>
                        <urn:v>$value1</urn:v>
                        <urn:v>$value2</urn:v>
                    </urn:default>
                </urn:a>
            </urn:getAttrs>
        </urn:rights>
    </urn:entries>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, StubEffectiveRightsTarget::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubEffectiveRightsTarget extends EffectiveRightsTarget
{
}
