<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\{ContactActionOp, Type};

use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicy;
use Zimbra\Mail\Struct\TagActionSelector;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TagActionSelector.
 */
class TagActionSelectorTest extends ZimbraTestCase
{
    public function testTagActionSelector()
    {
        $operation = $this->faker->randomElement(ContactActionOp::values())->getValue();
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;

        $retentionPolicy = new RetentionPolicy(
            [new Policy(Type::SYSTEM(), $id, $name, $lifetime)],
            [new Policy(Type::USER(), $id, $name, $lifetime)]
        );

        $action = new StubTagActionSelector(
            $operation, $retentionPolicy
        );
        $this->assertSame($retentionPolicy, $action->getRetentionPolicy());
        $action = new StubTagActionSelector($operation);
        $action->setRetentionPolicy($retentionPolicy);
        $this->assertSame($retentionPolicy, $action->getRetentionPolicy());

        $xml = <<<EOT
<?xml version="1.0"?>
<result op="$operation" xmlns:urn="urn:zimbraMail">
    <urn:retentionPolicy>
        <urn:keep>
            <urn:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
        </urn:keep>
        <urn:purge>
            <urn:policy type="user" id="$id" name="$name" lifetime="$lifetime" />
        </urn:purge>
    </urn:retentionPolicy>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, StubTagActionSelector::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubTagActionSelector extends TagActionSelector
{
}
