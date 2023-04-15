<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\ContactActionOp;
use Zimbra\Mail\Struct\ContactActionSelector;
use Zimbra\Mail\Struct\NewContactAttr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ContactActionSelector.
 */
class ContactActionSelectorTest extends ZimbraTestCase
{
    public function testContactActionSelector()
    {
        $operation = $this->faker->randomElement(ContactActionOp::cases())->value;
        $ids = $this->faker->uuid;
        $name = $this->faker->word;
        $attachId = $this->faker->uuid;
        $id = $this->faker->numberBetween(1, 100);
        $part = $this->faker->word;
        $value = $this->faker->word;

        $attr = new NewContactAttr(
            $name, $attachId, $id, $part, $value
        );

        $action = new StubContactActionSelector(
            $operation, $ids, [$attr]
        );
        $this->assertSame([$attr], $action->getAttrs());

        $action = new StubContactActionSelector($operation, $ids);
        $action->setAttrs([$attr])
            ->addAttr($attr);
        $this->assertSame([$attr, $attr], $action->getAttrs());
        $action->setAttrs([$attr]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$ids" op="$operation" xmlns:urn="urn:zimbraMail">
    <urn:attr n="$name" aid="$attachId" id="$id" part="$part">$value</urn:attr>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, StubContactActionSelector::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubContactActionSelector extends ContactActionSelector
{
}
