<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

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
        $operation = $this->faker->randomElement(ContactActionOp::values())->getValue();
        $ids = $this->faker->uuid;
        $name = $this->faker->word;
        $attachId = $this->faker->uuid;
        $id = $this->faker->numberBetween(1, 100);
        $part = $this->faker->word;
        $value = $this->faker->word;

        $attr = new NewContactAttr(
            $name, $attachId, $id, $part, $value
        );

        $action = new ContactActionSelector(
            $operation, $ids, [$attr]
        );
        $this->assertSame([$attr], $action->getAttrs());

        $action = new ContactActionSelector($operation, $ids);
        $action->setAttrs([$attr])
            ->addAttr($attr);
        $this->assertSame([$attr, $attr], $action->getAttrs());
        $action->setAttrs([$attr]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$ids" op="$operation">
    <attr n="$name" aid="$attachId" id="$id" part="$part">$value</attr>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, ContactActionSelector::class, 'xml'));

        $json = json_encode([
            'id' => $ids,
            'op' => $operation,
            'attr' => [
                [
                    'n' => $name,
                    'aid' => $attachId,
                    'id' => $id,
                    'part' => $part,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, ContactActionSelector::class, 'json'));
    }
}
