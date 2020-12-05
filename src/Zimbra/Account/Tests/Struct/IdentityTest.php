<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\Identity;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for Identity.
 */
class IdentityTest extends ZimbraStructTestCase
{
    public function testIdentity()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->word;

        $attr1 = new Attr($name, $value, TRUE);
        $attr2 = new Attr($name, $value, FALSE);

        $identity = new Identity($name, $id, [$attr1]);
        $this->assertSame($name, $identity->getName());
        $this->assertSame($id, $identity->getId());
        $this->assertSame([$attr1], $identity->getAttrs());

        $identity = new Identity('');
        $identity->setName($name)
                 ->setId($id)
                 ->setAttrs([$attr1])
                 ->addAttr($attr2);
        $this->assertSame($name, $identity->getName());
        $this->assertSame($id, $identity->getId());
        $this->assertSame([$attr1, $attr2], $identity->getAttrs());

        $xml = <<<EOT
<?xml version="1.0"?>
<identity name="$name" id="$id">
    <a name="$name" pd="true">$value</a>
    <a name="$name" pd="false">$value</a>
</identity>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($identity, 'xml'));
        $this->assertEquals($identity, $this->serializer->deserialize($xml, Identity::class, 'xml'));

        $json = json_encode([
            'a' => [
                [
                    'name' => $name,
                    '_content' => $value,
                    'pd' => TRUE,
                ],
                [
                    'name' => $name,
                    '_content' => $value,
                    'pd' => FALSE,
                ],
            ],
            'name' => $name,
            'id' => $id,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($identity, 'json'));
        $this->assertEquals($identity, $this->serializer->deserialize($json, Identity::class, 'json'));
    }
}
