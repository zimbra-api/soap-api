<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\Type;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RetentionPolicy.
 */
class RetentionPolicyTest extends ZimbraTestCase
{
    public function testRetentionPolicy()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;
        $keep = new Policy(Type::SYSTEM(), $id, $name, $lifetime);
        $purge = new Policy(Type::USER(), $id, $name, $lifetime);

        $retention = new RetentionPolicy([$keep], [$purge]);
        $this->assertSame([$keep], $retention->getKeepPolicy());
        $this->assertSame([$purge], $retention->getPurgePolicy());

        $retention = new RetentionPolicy();
        $retention->setKeepPolicy([$keep])
            ->setPurgePolicy([$purge]);
        $this->assertSame([$keep], $retention->getKeepPolicy());
        $this->assertSame([$purge], $retention->getPurgePolicy());

        $xml = <<<EOT
<?xml version="1.0"?>
<result>
    <keep>
        <policy type="system" id="$id" name="$name" lifetime="$lifetime" />
    </keep>
    <purge>
        <policy type="user" id="$id" name="$name" lifetime="$lifetime" />
    </purge>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($retention, 'xml'));
        $this->assertEquals($retention, $this->serializer->deserialize($xml, RetentionPolicy::class, 'xml'));
    }
}
