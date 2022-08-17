<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

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

        $retention = new StubRetentionPolicy([$keep], [$purge]);
        $this->assertSame([$keep], $retention->getKeepPolicy());
        $this->assertSame([$purge], $retention->getPurgePolicy());

        $retention = new StubRetentionPolicy();
        $retention->setKeepPolicy([$keep])
            ->setPurgePolicy([$purge]);
        $this->assertSame([$keep], $retention->getKeepPolicy());
        $this->assertSame([$purge], $retention->getPurgePolicy());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraMail">
    <urn:keep>
        <urn:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
    </urn:keep>
    <urn:purge>
        <urn:policy type="user" id="$id" name="$name" lifetime="$lifetime" />
    </urn:purge>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($retention, 'xml'));
        $this->assertEquals($retention, $this->serializer->deserialize($xml, StubRetentionPolicy::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubRetentionPolicy extends RetentionPolicy
{
}
