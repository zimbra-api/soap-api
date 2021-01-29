<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicy;
use Zimbra\Enum\Type;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for RetentionPolicy.
 */
class RetentionPolicyTest extends ZimbraStructTestCase
{
    public function testRetentionPolicy()
    {
        $id = $this->faker->word;
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
<retentionPolicy>
    <keep>
        <policy type="system" id="$id" name="$name" lifetime="$lifetime" />
    </keep>
    <purge>
        <policy type="user" id="$id" name="$name" lifetime="$lifetime" />
    </purge>
</retentionPolicy>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($retention, 'xml'));
        $this->assertEquals($retention, $this->serializer->deserialize($xml, RetentionPolicy::class, 'xml'));

        $json = json_encode([
            'keep' => [
                'policy' => [
                    [
                        'type' => 'system',
                        'id' => $id,
                        'name' => $name,
                        'lifetime' => $lifetime,
                    ],
                ],
            ],
            'purge' => [
                'policy' => [
                    [
                        'type' => 'user',
                        'id' => $id,
                        'name' => $name,
                        'lifetime' => $lifetime,
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($retention, 'json'));
        $this->assertEquals($retention, $this->serializer->deserialize($json, RetentionPolicy::class, 'json'));
    }
}
