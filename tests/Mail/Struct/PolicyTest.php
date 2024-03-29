<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\Type;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Policy.
 */
class PolicyTest extends ZimbraTestCase
{
    public function testPolicy()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;

        $policy = new Policy(Type::SYSTEM, $id, $name, $lifetime);
        $this->assertEquals(Type::SYSTEM, $policy->getType());
        $this->assertSame($id, $policy->getId());
        $this->assertSame($name, $policy->getName());
        $this->assertSame($lifetime, $policy->getLifetime());

        $policy = new Policy();
        $policy->setType(Type::USER)
               ->setId($id)
               ->setName($name)
               ->setLifetime($lifetime);
        $this->assertEquals(Type::USER, $policy->getType());
        $this->assertSame($id, $policy->getId());
        $this->assertSame($name, $policy->getName());
        $this->assertSame($lifetime, $policy->getLifetime());

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="user" id="$id" name="$name" lifetime="$lifetime" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($policy, 'xml'));
        $this->assertEquals($policy, $this->serializer->deserialize($xml, Policy::class, 'xml'));
    }
}
