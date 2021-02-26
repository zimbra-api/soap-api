<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\NewFolderSpec;
use Zimbra\Mail\Struct\ActionGrantSelector;
use Zimbra\Enum\{ActionGrantRight, GranteeType};
use Zimbra\Enum\ViewType;
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
        $defaultView = ViewType::CONVERSATION();
        $flags = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $url = $this->faker->word;

        $rights = implode(',', [ActionGrantRight::READ(), ActionGrantRight::WRITE()]);
        $grantType = GranteeType::USR();
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->name;
        $args = $this->faker->word;
        $password = $this->faker->word;
        $accessKey = $this->faker->word;

        $grant = new ActionGrantSelector(
            $rights, $grantType, $zimbraId, $displayName, $args, $password, $accessKey
        );

        $folder = new NewFolderSpec(
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

        $folder = new NewFolderSpec('', '');
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
<folder name="$name" view="conversation" f="$flags" color="$color" rgb="$rgb" url="$url" l="$parentFolderId" fie="true" sync="true">
    <acl>
        <grant perm="$rights" gt="usr" zid="$zimbraId" d="$displayName" args="$args" pw="$password" key="$accessKey" />
    </acl>
</folder>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($folder, 'xml'));
        $this->assertEquals($folder, $this->serializer->deserialize($xml, NewFolderSpec::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'view' => 'conversation',
            'f' => $flags,
            'rgb' => $rgb,
            'color' => $color,
            'url' => $url,
            'l' => $parentFolderId,
            'fie' => TRUE,
            'sync' => TRUE,
            'acl' => [
                'grant' => [
                    [
                        'perm' => $rights,
                        'gt' => 'usr',
                        'zid' => $zimbraId,
                        'd' => $displayName,
                        'args' => $args,
                        'pw' => $password,
                        'key' => $accessKey,
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($folder, 'json'));
        $this->assertEquals($folder, $this->serializer->deserialize($json, NewFolderSpec::class, 'json'));
    }
}
