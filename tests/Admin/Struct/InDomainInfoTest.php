<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

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

        $inDomain = new StubInDomainInfo($rights, [$domain]);
        $this->assertSame($rights, $inDomain->getRights());
        $this->assertSame([$domain], $inDomain->getDomains());

        $inDomain = new StubInDomainInfo(new EffectiveRightsInfo($setAttrs, $getAttrs));
        $inDomain->setRights($rights)
            ->setDomains([$domain])
            ->addDomain($domain);
        $this->assertSame($rights, $inDomain->getRights());
        $this->assertSame([$domain, $domain], $inDomain->getDomains());
        $inDomain = new StubInDomainInfo($rights, [$domain]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
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
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($inDomain, 'xml'));
        $this->assertEquals($inDomain, $this->serializer->deserialize($xml, StubInDomainInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubInDomainInfo extends InDomainInfo
{
}
