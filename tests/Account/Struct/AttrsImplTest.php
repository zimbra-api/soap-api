<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\AttrsImpl;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AttrsImpl.
 */
class AttrsImplTest extends ZimbraTestCase
{
    public function testAttrsImpl()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($name, $value, TRUE);
        $stub = new StubAttrsImpl();
 
        $stub->addAttr($attr);
        $this->assertSame([$attr], $stub->getAttrs());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAccount">
    <urn:a name="$name" pd="true">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stub, 'xml'));
        $this->assertEquals($stub, $this->serializer->deserialize($xml, StubAttrsImpl::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAccount', prefix: 'urn')]
class StubAttrsImpl extends AttrsImpl
{
}
