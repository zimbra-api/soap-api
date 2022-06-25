<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\IdEmailName;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for IdEmailName.
 */
class IdEmailNameTest extends ZimbraTestCase
{
    public function testIdEmailName()
    {
        $id = $this->faker->uuid;
        $email = $this->faker->email;
        $name = $this->faker->name;

        $doc = new IdEmailName(
            $id, $email, $name
        );
        $this->assertSame($id, $doc->getId());
        $this->assertSame($email, $doc->getEmail());
        $this->assertSame($name, $doc->getName());

        $doc = new IdEmailName();
        $doc->setId($id)
            ->setEmail($email)
            ->setName($name);
        $this->assertSame($id, $doc->getId());
        $this->assertSame($email, $doc->getEmail());
        $this->assertSame($name, $doc->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" email="$email" name="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($doc, 'xml'));
        $this->assertEquals($doc, $this->serializer->deserialize($xml, IdEmailName::class, 'xml'));
    }
}
