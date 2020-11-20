<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\AttrsImpl;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

use JMS\Serializer\Annotation\XmlRoot;

/**
 * Testcase class for AttrsImpl.
 */
class AttrsImplTest extends ZimbraStructTestCase
{
    public function testAttrsImpl()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($name, $value, TRUE);
        $stub = new StubAttrsImpl();
 
        $stub->addAttr($attr);
        $this->assertSame([$attr], $stub->getAttrs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<stub>'
                . '<a name="' . $name . '" pd="true">' . $value . '</a>'
            . '</stub>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stub, 'xml'));
        $this->assertEquals($stub, $this->serializer->deserialize($xml, StubAttrsImpl::class, 'xml'));

        $json = json_encode([
            'a' => [
                [
                    'name' => $name,
                    '_content' => $value,
                    'pd' => TRUE,
                ]
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($stub, 'json'));
        $this->assertEquals($stub, $this->serializer->deserialize($json, StubAttrsImpl::class, 'json'));
    }
}

/** @XmlRoot(name="stub") */
class StubAttrsImpl extends AttrsImpl
{
}
