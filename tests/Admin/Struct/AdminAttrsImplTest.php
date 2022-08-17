<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Admin\Struct\AdminAttrsImpl;
use Zimbra\Admin\Struct\Attr;

/**
 * Testcase class for AdminAttrsImpl.
 */
class AdminAttrsImplTest extends ZimbraTestCase
{
    public function testAdminAttrsImpl()
    {
        $stub = new StubAdminAttrsImpl();

        $key1 = $this->faker->unique->word;
        $value1 = $this->faker->unique->word;
        $key2 = $this->faker->unique->word;
        $value2 = $this->faker->unique->word;
        $key3 = $this->faker->unique->word;
        $value3 = $this->faker->unique->word;

        $attr1 = new Attr($key1, $value1);
        $attr2 = new Attr($key2, $value2);
        $attr3 = new Attr($key3, $value3);
        $stub->setAttrs([$attr1, $attr2])->addAttr($attr3);
        foreach ($stub->getAttrs() as $attr) {
            $this->assertInstanceOf(Attr::class, $attr);
        }

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key1">$value1</urn:a>
    <urn:a n="$key2">$value2</urn:a>
    <urn:a n="$key3">$value3</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stub, 'xml'));
        $this->assertEquals($stub, $this->serializer->deserialize($xml, StubAdminAttrsImpl::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubAdminAttrsImpl extends AdminAttrsImpl
{
}
