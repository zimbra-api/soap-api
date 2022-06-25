<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\EffectiveAttrInfo;
use Zimbra\Admin\Struct\EffectiveAttrsInfo;
use Zimbra\Admin\Struct\EffectiveRightsInfo;
use Zimbra\Admin\Struct\InDomainInfo;
use Zimbra\Admin\Struct\RightWithName;
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for InDomainInfo.
 */
class InDomainInfoTest extends ZimbraTestCase
{
    public function testInDomainInfo()
    {
        $name = $this->faker->word;
        $value1= $this->faker->text;
        $value2= $this->faker->text;
        $max= $this->faker->word;
        $min= $this->faker->word;

        $right = new RightWithName($name);
        $constraint = new ConstraintInfo($min, $max, [$value1, $value2]);
        $attr = new EffectiveAttrInfo($name, $constraint, [$value1, $value2]);
        $setAttrs = new EffectiveAttrsInfo(TRUE, [$attr]);
        $getAttrs = new EffectiveAttrsInfo(FALSE, [$attr]);

        $rights = new EffectiveRightsInfo($setAttrs, $getAttrs, [$right]);
        $domain = new NamedElement($name);

        $inDomain = new InDomainInfo($rights, [$domain]);
        $this->assertSame($rights, $inDomain->getRights());
        $this->assertSame([$domain], $inDomain->getDomains());

        $inDomain = new InDomainInfo(new EffectiveRightsInfo($setAttrs, $getAttrs));
        $inDomain->setRights($rights)
            ->setDomains([$domain])
            ->addDomain($domain);
        $this->assertSame($rights, $inDomain->getRights());
        $this->assertSame([$domain, $domain], $inDomain->getDomains());
        $inDomain = new InDomainInfo($rights, [$domain]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result>
    <domain name="$name" />
    <rights>
        <right n="$name" />
        <setAttrs all="true">
            <a n="$name">
                <constraint>
                    <min>$min</min>
                    <max>$max</max>
                    <values>
                        <v>$value1</v>
                        <v>$value2</v>
                    </values>
                </constraint>
                <default>
                    <v>$value1</v>
                    <v>$value2</v>
                </default>
            </a>
        </setAttrs>
        <getAttrs all="false">
            <a n="$name">
                <constraint>
                    <min>$min</min>
                    <max>$max</max>
                    <values>
                        <v>$value1</v>
                        <v>$value2</v>
                    </values>
                </constraint>
                <default>
                    <v>$value1</v>
                    <v>$value2</v>
                </default>
            </a>
        </getAttrs>
    </rights>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($inDomain, 'xml'));
        $this->assertEquals($inDomain, $this->serializer->deserialize($xml, InDomainInfo::class, 'xml'));
    }
}
