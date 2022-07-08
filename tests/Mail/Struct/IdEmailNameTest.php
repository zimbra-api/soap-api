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

        $user = new IdEmailName(
            $id, $email, $name
        );
        $this->assertSame($id, $user->getId());
        $this->assertSame($email, $user->getEmail());
        $this->assertSame($name, $user->getName());

        $user = new IdEmailName();
        $user->setId($id)
            ->setEmail($email)
            ->setName($name);
        $this->assertSame($id, $user->getId());
        $this->assertSame($email, $user->getEmail());
        $this->assertSame($name, $user->getName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" email="$email" name="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($user, 'xml'));
        $this->assertEquals($user, $this->serializer->deserialize($xml, IdEmailName::class, 'xml'));
    }
}
