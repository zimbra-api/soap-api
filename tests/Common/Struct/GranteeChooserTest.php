<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use Zimbra\Common\Struct\GranteeChooser;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GranteeChooser.
 */
class GranteeChooserTest extends ZimbraTestCase
{
    public function testGranteeChooser()
    {
        $type = $this->faker->word;
        $id = $this->faker->word;
        $name = $this->faker->word;

        $grantee = new GranteeChooser($type, $id, $name);
        $this->assertSame($type, $grantee->getType());
        $this->assertSame($id, $grantee->getId());
        $this->assertSame($name, $grantee->getName());

        $grantee = new GranteeChooser();
        $grantee->setType($type)
                ->setId($id)
                ->setName($name);
        $this->assertSame($type, $grantee->getType());
        $this->assertSame($id, $grantee->getId());
        $this->assertSame($name, $grantee->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type" id="$id" name="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grantee, 'xml'));
        $this->assertEquals($grantee, $this->serializer->deserialize($xml, GranteeChooser::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            'id' => $id,
            'name' => $name,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($grantee, 'json'));
        $this->assertEquals($grantee, $this->serializer->deserialize($json, GranteeChooser::class, 'json'));
    }
}
