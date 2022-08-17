<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\PolicyHolder;
use Zimbra\Common\Enum\Type;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for PolicyHolder.
 */
class PolicyHolderTest extends ZimbraTestCase
{
    public function testPolicyHolder()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;
        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);

        $holder = new StubPolicyHolder($policy);
        $this->assertSame($policy, $holder->getPolicy());

        $holder = new StubPolicyHolder();
        $holder->setPolicy($policy);
        $this->assertSame($policy, $holder->getPolicy());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraMail">
    <urn:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($holder, 'xml'));
        $this->assertEquals($holder, $this->serializer->deserialize($xml, StubPolicyHolder::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubPolicyHolder extends PolicyHolder
{
}
