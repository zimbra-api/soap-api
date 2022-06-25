<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\IdVersionName;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for IdVersionName.
 */
class IdVersionNameTest extends ZimbraTestCase
{
    public function testIdVersionName()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;
        $version = $this->faker->randomNumber;

        $doc = new IdVersionName(
            $id, $version, $name
        );
        $this->assertSame($id, $doc->getId());
        $this->assertSame($version, $doc->getVersion());
        $this->assertSame($name, $doc->getName());

        $doc = new IdVersionName('', 0, '');
        $doc->setId($id)
            ->setVersion($version)
            ->setName($name);
        $this->assertSame($id, $doc->getId());
        $this->assertSame($version, $doc->getVersion());
        $this->assertSame($name, $doc->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" ver="$version" name="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($doc, 'xml'));
        $this->assertEquals($doc, $this->serializer->deserialize($xml, IdVersionName::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'ver' => $version,
            'name' => $name,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($doc, 'json'));
        $this->assertEquals($doc, $this->serializer->deserialize($json, IdVersionName::class, 'json'));
    }
}
