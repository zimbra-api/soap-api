<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\GranteeWithType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GranteeWithType.
 */
class GranteeWithTypeTest extends ZimbraTestCase
{
    public function testGranteeWithType()
    {
        $type = $this->faker->word;
        $value = $this->faker->word;
        $grantee = new GranteeWithType($type, $value);
        $this->assertSame($type, $grantee->getType());
        $this->assertSame($value, $grantee->getValue());

        $grantee = new GranteeWithType('');
        $grantee->setType($type)
               ->setValue($value);
        $this->assertSame($type, $grantee->getType());
        $this->assertSame($value, $grantee->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grantee, 'xml'));
        $this->assertEquals($grantee, $this->serializer->deserialize($xml, GranteeWithType::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($grantee, 'json'));
        $this->assertEquals($grantee, $this->serializer->deserialize($json, GranteeWithType::class, 'json'));
    }
}
