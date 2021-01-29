<?php declare(strict_types=1);

namespace Zimbra\Tests\Struct;

use Zimbra\Enum\InterestType;
use Zimbra\Struct\WaitSetAddSpec;

/**
 * Testcase class for WaitSetAddSpec.
 */
class WaitSetAddSpecTest extends ZimbraStructTestCase
{
    public function testWaitSetAddSpec()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;
        $token = $this->faker->word;
        $interests = [
            $this->faker->word,
            InterestType::FOLDERS()->getValue(),
            InterestType::MESSAGES()->getValue(),
            InterestType::CONTACTS()->getValue(),
        ];

        $waitSet = new WaitSetAddSpec($name, $id, $token, implode(',', $interests));
        $this->assertSame($name, $waitSet->getName());
        $this->assertSame($id, $waitSet->getId());
        $this->assertSame($token, $waitSet->getToken());
        $this->assertSame('f,m,c', $waitSet->getInterests());

        $waitSet = new WaitSetAddSpec();
        $waitSet->setName($name)
                ->setId($id)
                ->setToken($token)
                ->setInterests(implode(',', $interests));
        $this->assertSame($name, $waitSet->getName());
        $this->assertSame($id, $waitSet->getId());
        $this->assertSame($token, $waitSet->getToken());
        $this->assertSame('f,m,c', $waitSet->getInterests());

        $xml = <<<EOT
<?xml version="1.0"?>
<a name="$name" id="$id" token="$token" types="f,m,c" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($waitSet, 'xml'));
        $this->assertEquals($waitSet, $this->serializer->deserialize($xml, WaitSetAddSpec::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
            'token' => $token,
            'types' => 'f,m,c',
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($waitSet, 'json'));
        $this->assertEquals($waitSet, $this->serializer->deserialize($json, WaitSetAddSpec::class, 'json'));
    }
}
