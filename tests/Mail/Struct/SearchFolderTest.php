<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\ItemType;
use Zimbra\Common\Enum\SearchSortBy;
use Zimbra\Mail\Struct\Folder;
use Zimbra\Mail\Struct\SearchFolder;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SearchFolder.
 */
class SearchFolderTest extends ZimbraTestCase
{
    public function testSearchFolder()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $query = $this->faker->word;
        $sortBy = SearchSortBy::DATE_DESC;
        $types = implode(',', [ItemType::MESSAGE->value, ItemType::CONVERSATION->value]);

        $search = new SearchFolder(
            $id,
            $uuid,
            $query,
            $sortBy,
            $types
        );
        $this->assertTrue($search instanceof Folder);
        $this->assertSame($query, $search->getQuery());
        $this->assertSame($sortBy, $search->getSortBy());
        $this->assertSame($types, $search->getTypes());

        $search = new SearchFolder(
            $id,
            $uuid
        );
        $search->setQuery($query)
            ->setSortBy($sortBy)
            ->setTypes($types);

        $this->assertSame($query, $search->getQuery());
        $this->assertSame($sortBy, $search->getSortBy());
        $this->assertSame($types, $search->getTypes());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" uuid="$uuid" query="$query" sortBy="dateDesc" types="$types" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($search, 'xml'));
        $this->assertEquals($search, $this->serializer->deserialize($xml, SearchFolder::class, 'xml'));
    }
}
