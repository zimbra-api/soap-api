<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\Policy;
use Zimbra\Enum\Type;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for Policy.
 */
class PolicyTest extends ZimbraStructTestCase
{
    public function testPolicy()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;

        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);
        $this->assertEquals(Type::SYSTEM(), $policy->getType());
        $this->assertSame($id, $policy->getId());
        $this->assertSame($name, $policy->getName());
        $this->assertSame($lifetime, $policy->getLifetime());

        $policy = new Policy();
        $policy->setType(Type::USER())
               ->setId($id)
               ->setName($name)
               ->setLifetime($lifetime);
        $this->assertEquals(Type::USER(), $policy->getType());
        $this->assertSame($id, $policy->getId());
        $this->assertSame($name, $policy->getName());
        $this->assertSame($lifetime, $policy->getLifetime());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<policy type="' . Type::USER() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($policy, 'xml'));
        $this->assertEquals($policy, $this->serializer->deserialize($xml, Policy::class, 'xml'));

        $json = json_encode([
            'type' => (string) Type::USER(),
            'id' => $id,
            'name' => $name,
            'lifetime' => $lifetime,
        ]);
        $this->assertSame($json, $this->serializer->serialize($policy, 'json'));
        $this->assertEquals($policy, $this->serializer->deserialize($json, Policy::class, 'json'));
    }
}
