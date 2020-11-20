<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\AuthAttrs;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AuthAttrs.
 */
class AuthAttrsTest extends ZimbraStructTestCase
{
    public function testAuthAttrs()
    {
        $name1 = $this->faker->word;
        $value1 = $this->faker->word;
        $attr1 = new Attr($name1, $value1, TRUE);

        $attrs = new AuthAttrs([$attr1]);
        $this->assertSame([$attr1], $attrs->getAttrs());

        $name2 = $this->faker->word;
        $value2 = $this->faker->word;
        $attr2 = new Attr($name2, $value2, FALSE);

        $attrs->addAttr($attr2);
        $this->assertSame([$attr1, $attr2], $attrs->getAttrs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attrs>'
                . '<attr name="' . $name1 . '" pd="true">' . $value1 . '</attr>'
                . '<attr name="' . $name2 . '" pd="false">' . $value2 . '</attr>'
            . '</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attrs, 'xml'));
        $this->assertEquals($attrs, $this->serializer->deserialize($xml, AuthAttrs::class, 'xml'));

        $json = json_encode([
            'attr' => [
                [
                    'name' => $name1,
                    '_content' => $value1,
                    'pd' => TRUE,
                ],
                [
                    'name' => $name2,
                    '_content' => $value2,
                    'pd' => FALSE,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attrs, 'json'));
        $this->assertEquals($attrs, $this->serializer->deserialize($json, AuthAttrs::class, 'json'));
    }
}
