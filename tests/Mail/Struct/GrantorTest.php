<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\Grantor;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Grantor.
 */
class GrantorTest extends ZimbraTestCase
{
    public function testGrantor()
    {
        $id = $this->faker->uuid;
        $email = $this->faker->email;
        $name = $this->faker->name;

        $grantor = new Grantor(
            $id, $email, $name
        );
        $this->assertSame($id, $grantor->getId());
        $this->assertSame($email, $grantor->getEmail());
        $this->assertSame($name, $grantor->getName());

        $grantor = new Grantor();
        $grantor->setId($id)
            ->setEmail($email)
            ->setName($name);
        $this->assertSame($id, $grantor->getId());
        $this->assertSame($email, $grantor->getEmail());
        $this->assertSame($name, $grantor->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" email="$email" name="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grantor, 'xml'));
        $this->assertEquals($grantor, $this->serializer->deserialize($xml, Grantor::class, 'xml'));
    }
}
