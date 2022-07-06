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

        $link = new LinkInfo(
            $id, $uuid, $name, $defaultView, $rights
        );
        $this->assertSame($id, $link->getId());
        $this->assertSame($uuid, $link->getUuid());
        $this->assertSame($name, $link->getName());
        $this->assertSame($defaultView, $link->getDefaultView());
        $this->assertSame($rights, $link->getRights());

        $link = new LinkInfo();
        $link->setId($id)
            ->setUuid($uuid)
            ->setName($name)
            ->setDefaultView($defaultView)
            ->setRights($rights);
        $this->assertSame($id, $link->getId());
        $this->assertSame($uuid, $link->getUuid());
        $this->assertSame($name, $link->getName());
        $this->assertSame($defaultView, $link->getDefaultView());
        $this->assertSame($rights, $link->getRights());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" uuid="$uuid" name="$name" view="$defaultView" perm="$rights" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($link, 'xml'));
        $this->assertEquals($link, $this->serializer->deserialize($xml, LinkInfo::class, 'xml'));
    }
}
