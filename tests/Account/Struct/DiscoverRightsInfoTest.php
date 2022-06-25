<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

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
        $type = TargetType::ACCOUNT();
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $displayName = $this->faker->word;
        $addr = $this->faker->word;
        $right = $this->faker->word;

        $target = new DiscoverRightsTarget($type, $id, $name, $displayName, [new DiscoverRightsEmail($addr)]);
        $targets = new DiscoverRightsInfo($right, [$target]);

        $this->assertSame($right, $targets->getRight());
        $this->assertSame([$target], $targets->getTargets());

        $targets = new DiscoverRightsInfo('');
        $targets->setRight($right)
            ->setTargets([$target])
            ->addTarget($target);
        $this->assertSame($right, $targets->getRight());
        $this->assertSame([$target, $target], $targets->getTargets());
        $targets->setTargets([$target]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result right="$right">
    <target type="$type" id="$id" name="$name" d="$displayName">
        <email addr="$addr" />
    </target>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($targets, 'xml'));
        $this->assertEquals($targets, $this->serializer->deserialize($xml, DiscoverRightsInfo::class, 'xml'));
    }
}
