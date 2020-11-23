<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\AdminZimletGlobalConfigInfo;
use Zimbra\Admin\Struct\AdminZimletProperty;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminZimletGlobalConfigInfo.
 */
class AdminZimletGlobalConfigInfoTest extends ZimbraStructTestCase
{
    public function testAdminZimletGlobalConfigInfo()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;

        $property = new AdminZimletProperty($name, $value);

        $global = new AdminZimletGlobalConfigInfo([$property]);
        $this->assertSame([$property], $global->getZimletProperties());

        $global = new AdminZimletGlobalConfigInfo;
        $global->setZimletProperties([$property])
            ->addZimletProperty($property);
        $this->assertSame([$property, $property], $global->getZimletProperties());
        $global->setZimletProperties([$property]);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<global>'
                . '<property name="' . $name . '">' . $value. '</property>'
            . '</global>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($global, 'xml'));
        $this->assertEquals($global, $this->serializer->deserialize($xml, AdminZimletGlobalConfigInfo::class, 'xml'));

        $json = json_encode([
            'property' => [
                [
                    'name' => $name,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($global, 'json'));
        $this->assertEquals($global, $this->serializer->deserialize($json, AdminZimletGlobalConfigInfo::class, 'json'));
    }
}
