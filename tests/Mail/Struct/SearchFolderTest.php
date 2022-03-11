<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\ItemType;
use Zimbra\Enum\SearchSortBy;
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
        $sortBy = SearchSortBy::DATE_DESC();
        $types = implode(',', [ItemType::MESSAGE(), ItemType::CONVERSATION()]);

        $search = new SearchFolder(
            $id, $uuid
        );
        $search->setQuery($query)
            ->setSortBy($sortBy)
            ->setTypes($types);

        $this->assertTrue($search instanceof Folder);
        $this->assertSame($query, $search->getQuery());
        $this->assertSame($sortBy, $search->getSortBy());
        $this->assertSame($types, $search->getTypes());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" uuid="$uuid" query="$query" sortBy="dateDesc" types="$types" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($search, 'xml'));
        $this->assertEquals($search, $this->serializer->deserialize($xml, SearchFolder::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'uuid' => $uuid,
            'query' => $query,
            'sortBy' => 'dateDesc',
            'types' => $types,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($search, 'json'));
        $this->assertEquals($search, $this->serializer->deserialize($json, SearchFolder::class, 'json'));
    }
}
