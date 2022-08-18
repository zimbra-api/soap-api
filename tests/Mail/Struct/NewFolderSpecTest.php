<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\NewFolderSpec;
use Zimbra\Mail\Struct\ActionGrantSelector;
use Zimbra\Common\Enum\{ActionGrantRight, GranteeType, ViewType};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NewFolderSpec.
 */
class NewFolderSpecTest extends ZimbraTestCase
{
    public function testNewFolderSpec()
    {
        $name = $this->faker->word;
        $parentFolderId = $this->faker->uuid;
        $defaultView = ViewType::CONVERSATION;
        $flags = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $url = $this->faker->word;

        $rights = implode(',', [ActionGrantRight::READ->value, ActionGrantRight::WRITE->value]);
        $grantType = GranteeType::USR;
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $args = $this->faker->word;
        $password = $this->faker->word;
        $accessKey = $this->faker->word;

        $grant = new ActionGrantSelector(
            $rights, $grantType, $zimbraId, $displayName, $args, $password, $accessKey
        );

        $folder = new StubNewFolderSpec(
            $name, $parentFolderId, $defaultView, $flags, $color, $rgb, $url, FALSE, FALSE, [$grant]
        );
        $this->assertSame($name, $folder->getName());
        $this->assertSame($parentFolderId, $folder->getParentFolderId());
        $this->assertSame($defaultView, $folder->getDefaultView());
        $this->assertSame($flags, $folder->getFlags());
        $this->assertSame($color, $folder->getColor());
        $this->assertSame($rgb, $folder->getRgb());
        $this->assertSame($url, $folder->getUrl());
        $this->assertFalse($folder->getFetchIfExists());
        $this->assertFalse($folder->getSyncToUrl());
        $this->assertSame([$grant], $folder->getGrants());

        $folder = new StubNewFolderSpec();
        $folder->setName($name)
            ->setParentFolderId($parentFolderId)
            ->setDefaultView($defaultView)
            ->setFlags($flags)
            ->setColor($color)
            ->setRgb($rgb)
            ->setUrl($url)
            ->setFetchIfExists(TRUE)
            ->setSyncToUrl(TRUE)
            ->setGrants([$grant])
            ->addGrant($grant);
        $this->assertSame($name, $folder->getName());
        $this->assertSame($parentFolderId, $folder->getParentFolderId());
        $this->assertSame($defaultView, $folder->getDefaultView());
        $this->assertSame($flags, $folder->getFlags());
        $this->assertSame($color, $folder->getColor());
        $this->assertSame($rgb, $folder->getRgb());
        $this->assertSame($url, $folder->getUrl());
        $this->assertTrue($folder->getFetchIfExists());
        $this->assertTrue($folder->getSyncToUrl());
        $this->assertSame([$grant, $grant], $folder->getGrants());
        $folder->setGrants([$grant]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" view="conversation" f="$flags" color="$color" rgb="$rgb" url="$url" l="$parentFolderId" fie="true" sync="true" xmlns:urn="urn:zimbraMail">
    <urn:acl>
        <urn:grant perm="$rights" gt="usr" zid="$zimbraId" d="$displayName" args="$args" pw="$password" key="$accessKey" />
    </urn:acl>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($folder, 'xml'));
        $this->assertEquals($folder, $this->serializer->deserialize($xml, StubNewFolderSpec::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubNewFolderSpec extends NewFolderSpec
{
}
