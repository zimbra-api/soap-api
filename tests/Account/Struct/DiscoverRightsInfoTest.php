<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Account\Struct\DiscoverRightsEmail;
use Zimbra\Account\Struct\DiscoverRightsInfo;
use Zimbra\Account\Struct\DiscoverRightsTarget;
use Zimbra\Common\Enum\TargetType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DiscoverRightsInfo.
 */
class DiscoverRightsInfoTest extends ZimbraTestCase
{
    public function testDiscoverRightsInfo()
    {
        $type = TargetType::ACCOUNT;
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $displayName = $this->faker->word;
        $addr = $this->faker->word;
        $right = $this->faker->word;

        $target = new DiscoverRightsTarget($type, $id, $name, $displayName, [new DiscoverRightsEmail($addr)]);
        $targets = new MockDiscoverRightsInfo($right, [$target]);

        $this->assertSame($right, $targets->getRight());
        $this->assertSame([$target], $targets->getTargets());

        $targets = new MockDiscoverRightsInfo();
        $targets->setRight($right)
            ->setTargets([$target]);
        $this->assertSame($right, $targets->getRight());
        $this->assertSame([$target], $targets->getTargets());

        $xml = <<<EOT
<?xml version="1.0"?>
<result right="$right" xmlns:urn="urn:zimbraAccount">
    <urn:target type="$type" id="$id" name="$name" d="$displayName">
        <urn:email addr="$addr" />
    </urn:target>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($targets, 'xml'));
        $this->assertEquals($targets, $this->serializer->deserialize($xml, MockDiscoverRightsInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAccount', prefix: "urn")]
class MockDiscoverRightsInfo extends DiscoverRightsInfo
{
}
