<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\LinkInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for LinkInfo.
 */
class LinkInfoTest extends ZimbraTestCase
{
    public function testLinkInfo()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $name = $this->faker->name;
        $defaultView = $this->faker->word;
        $rights = $this->faker->word;

        $info = new LinkInfo(
            $id, $uuid, $name, $defaultView, $rights
        );
        $this->assertSame($id, $info->getId());
        $this->assertSame($uuid, $info->getUuid());
        $this->assertSame($name, $info->getName());
        $this->assertSame($defaultView, $info->getDefaultView());
        $this->assertSame($rights, $info->getRights());

        $info = new LinkInfo();
        $info->setId($id)
            ->setUuid($uuid)
            ->setName($name)
            ->setDefaultView($defaultView)
            ->setRights($rights);
        $this->assertSame($id, $info->getId());
        $this->assertSame($uuid, $info->getUuid());
        $this->assertSame($name, $info->getName());
        $this->assertSame($defaultView, $info->getDefaultView());
        $this->assertSame($rights, $info->getRights());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" uuid="$uuid" name="$name" view="$defaultView" perm="$rights" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, LinkInfo::class, 'xml'));
    }
}
