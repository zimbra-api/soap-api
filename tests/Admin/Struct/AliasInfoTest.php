<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\AliasInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Common\Enum\TargetType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AliasInfo.
 */
class AliasInfoTest extends ZimbraTestCase
{
    public function testAliasInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $targetName = $this->faker->word;
        $targetType = TargetType::ACCOUNT();

        $alias = new StubAliasInfo($name, $id, $targetName, $targetType);
        $this->assertSame($targetName, $alias->getTargetName());
        $this->assertSame($targetType, $alias->getTargetType());

        $alias = new StubAliasInfo($name, $id, '', TargetType::ACCOUNT(), [new Attr($key, $value)]);
        $alias->setTargetName($targetName)
            ->setTargetType($targetType);
        $this->assertSame($targetName, $alias->getTargetName());
        $this->assertSame($targetType, $alias->getTargetType());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" targetName="$targetName" type="$targetType" xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($alias, 'xml'));
        $this->assertEquals($alias, $this->serializer->deserialize($xml, StubAliasInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubAliasInfo extends AliasInfo
{
}
