<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\DiscoverRightsEmail;
use Zimbra\Account\Struct\DiscoverRightsTarget;
use Zimbra\Enum\TargetType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DiscoverRightsTarget.
 */
class DiscoverRightsTargetTest extends ZimbraTestCase
{
    public function testDiscoverRightsTarget()
    {
        $type = TargetType::ACCOUNT();
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $displayName = $this->faker->word;
        $addr = $this->faker->word;

        $email = new DiscoverRightsEmail($addr);

        $target = new DiscoverRightsTarget($type, $id, $name, $displayName, [$email]);
        $this->assertSame($type, $target->getType());
        $this->assertSame($id, $target->getId());
        $this->assertSame($name, $target->getName());
        $this->assertSame($displayName, $target->getDisplayName());
        $this->assertSame([$email], $target->getEmails());

        $target = new DiscoverRightsTarget(TargetType::DOMAIN());
        $target->setType($type)
            ->setId($id)
            ->setName($name)
            ->setDisplayName($displayName)
            ->setEmails([$email])
            ->addEmail($email);
        $this->assertSame($type, $target->getType());
        $this->assertSame($id, $target->getId());
        $this->assertSame($name, $target->getName());
        $this->assertSame($displayName, $target->getDisplayName());
        $this->assertSame([$email, $email], $target->getEmails());
        $target->setEmails([$email]);

        $xml = <<<EOT
<?xml version="1.0"?>
<target type="$type" id="$id" name="$name" d="$displayName">
    <email addr="$addr" />
</target>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, DiscoverRightsTarget::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            'id' => $id,
            'name' => $name,
            'd' => $displayName,
            'email' => [
                [
                    'addr' => $addr,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($target, 'json'));
        $this->assertEquals($target, $this->serializer->deserialize($json, DiscoverRightsTarget::class, 'json'));
    }
}
