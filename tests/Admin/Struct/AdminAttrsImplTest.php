<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

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

        $key1 = $this->faker->word;
        $value1 = $this->faker->word;
        $key2 = $this->faker->word;
        $value2 = $this->faker->word;
        $key3 = $this->faker->word;
        $value3 = $this->faker->word;

        $attr1 = new Attr($key1, $value1);
        $attr2 = new Attr($key2, $value2);
        $attr3 = new Attr($key3, $value3);
        $stub->setAttrs([$attr1, $attr2])->addAttr($attr3);
        foreach ($stub->getAttrs() as $attr) {
            $this->assertInstanceOf(Attr::class, $attr);
        }

        $xml = <<<EOT
<?xml version="1.0"?>
<result>
    <a n="$key1">$value1</a>
    <a n="$key2">$value2</a>
    <a n="$key3">$value3</a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($stub, 'xml'));
        $this->assertEquals($stub, $this->serializer->deserialize($xml, StubAdminAttrsImpl::class, 'xml'));

        $json = json_encode([
            'a' => [
                [
                    'n' => $key1,
                    '_content' => $value1,
                ],
                [
                    'n' => $key2,
                    '_content' => $value2,
                ],
                [
                    'n' => $key3,
                    '_content' => $value3,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($stub, 'json'));
        $this->assertEquals($stub, $this->serializer->deserialize($json, StubAdminAttrsImpl::class, 'json'));
    }
}

class StubAdminAttrsImpl extends AdminAttrsImpl
{
}
