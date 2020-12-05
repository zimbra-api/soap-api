<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\Policy;
use Zimbra\Admin\Struct\PolicyHolder;
use Zimbra\Enum\Type;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for PolicyHolder.
 */
class PolicyHolderTest extends ZimbraStructTestCase
{
    public function testPolicyHolder()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;
        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);

        $holder = new PolicyHolder($policy);
        $this->assertSame($policy, $holder->getPolicy());

        $holder = new PolicyHolder();
        $holder->setPolicy($policy);
        $this->assertSame($policy, $holder->getPolicy());

        $namespace = 'urn:zimbraMail';
        $prefix = 'ns-' . substr(sha1($namespace), 0, 8);

        $type = Type::SYSTEM()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<holder>
    <$prefix:policy xmlns:$prefix="$namespace" type="$type" id="$id" name="$name" lifetime="$lifetime" />
</holder>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($holder, 'xml'));
        $this->assertEquals($holder, $this->serializer->deserialize($xml, PolicyHolder::class, 'xml'));

        $json = json_encode([
            'policy' => [
                'type' => $type,
                'id' => $id,
                'name' => $name,
                'lifetime' => $lifetime,
                '_jsns' => 'urn:zimbraMail',
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($holder, 'json'));
        $this->assertEquals($holder, $this->serializer->deserialize($json, PolicyHolder::class, 'json'));
    }
}
