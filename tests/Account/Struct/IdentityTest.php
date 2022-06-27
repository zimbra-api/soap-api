<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\Identity;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Identity.
 */
class IdentityTest extends ZimbraTestCase
{
    public function testIdentity()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->word;

        $attr1 = new Attr($name, $value, TRUE);
        $attr2 = new Attr($name, $value, FALSE);

        $identity = new MockIdentity($name, $id, [$attr1]);
        $this->assertSame($name, $identity->getName());
        $this->assertSame($id, $identity->getId());
        $this->assertSame([$attr1], $identity->getAttrs());

        $identity = new MockIdentity('');
        $identity->setName($name)
                 ->setId($id)
                 ->setAttrs([$attr1])
                 ->addAttr($attr2);
        $this->assertSame($name, $identity->getName());
        $this->assertSame($id, $identity->getId());
        $this->assertSame([$attr1, $attr2], $identity->getAttrs());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" xmlns:urn="urn:zimbraAccount">
    <urn:a name="$name" pd="true">$value</urn:a>
    <urn:a name="$name" pd="false">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($identity, 'xml'));
        $this->assertEquals($identity, $this->serializer->deserialize($xml, MockIdentity::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAccount", prefix="urn")
 */
class MockIdentity extends Identity
{
}
