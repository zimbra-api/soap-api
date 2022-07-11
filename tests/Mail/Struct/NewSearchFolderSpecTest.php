<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\ItemType;
use Zimbra\Common\Enum\SearchSortBy;
use Zimbra\Mail\Struct\NewSearchFolderSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NewSearchFolderSpec.
 */
class NewSearchFolderSpecTest extends ZimbraTestCase
{
    public function testNewSearchFolderSpec()
    {
        $name = $this->faker->word;
        $query = $this->faker->word;
        $searchTypes = implode(',', [ItemType::MESSAGE(), ItemType::CONVERSATION()]);
        $sortBy = SearchSortBy::DATE_DESC();
        $flags = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $parentFolderId = $this->faker->uuid;

        $folder = new NewSearchFolderSpec(
            $name, $query, $searchTypes, $sortBy, $flags, $color, $rgb, $parentFolderId
        );
        $this->assertSame($name, $folder->getName());
        $this->assertSame($query, $folder->getQuery());
        $this->assertSame($searchTypes, $folder->getSearchTypes());
        $this->assertSame($sortBy, $folder->getSortBy());
        $this->assertSame($flags, $folder->getFlags());
        $this->assertSame($color, $folder->getColor());
        $this->assertSame($rgb, $folder->getRgb());
        $this->assertSame($parentFolderId, $folder->getParentFolderId());

        $folder = new NewSearchFolderSpec();
        $folder->setName($name)
            ->setQuery($query)
            ->setSearchTypes($searchTypes)
            ->setSortBy($sortBy)
            ->setFlags($flags)
            ->setColor($color)
            ->setRgb($rgb)
            ->setParentFolderId($parentFolderId);
        $this->assertSame($name, $folder->getName());
        $this->assertSame($query, $folder->getQuery());
        $this->assertSame($searchTypes, $folder->getSearchTypes());
        $this->assertSame($sortBy, $folder->getSortBy());
        $this->assertSame($flags, $folder->getFlags());
        $this->assertSame($color, $folder->getColor());
        $this->assertSame($rgb, $folder->getRgb());
        $this->assertSame($parentFolderId, $folder->getParentFolderId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" query="$query" types="$searchTypes" sortBy="dateDesc" f="$flags" color="$color" rgb="$rgb" l="$parentFolderId" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($folder, 'xml'));
        $this->assertEquals($folder, $this->serializer->deserialize($xml, NewSearchFolderSpec::class, 'xml'));
    }
}
