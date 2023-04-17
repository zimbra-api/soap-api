<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\ItemType;
use Zimbra\Common\Enum\SearchSortBy;
use Zimbra\Mail\Struct\ModifySearchFolderSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifySearchFolderSpec.
 */
class ModifySearchFolderSpecTest extends ZimbraTestCase
{
    public function testModifySearchFolderSpec()
    {
        $id = $this->faker->uuid;
        $query = $this->faker->word;
        $searchTypes = implode(',', [ItemType::MESSAGE->value, ItemType::CONVERSATION->value]);
        $sortBy = SearchSortBy::DATE_DESC;

        $folder = new ModifySearchFolderSpec(
            $id, $query, $searchTypes, $sortBy
        );
        $this->assertSame($id, $folder->getId());
        $this->assertSame($query, $folder->getQuery());
        $this->assertSame($searchTypes, $folder->getSearchTypes());
        $this->assertSame($sortBy, $folder->getSortBy());

        $folder = new ModifySearchFolderSpec();
        $folder->setId($id)
            ->setQuery($query)
            ->setSearchTypes($searchTypes)
            ->setSortBy($sortBy);
        $this->assertSame($id, $folder->getId());
        $this->assertSame($query, $folder->getQuery());
        $this->assertSame($searchTypes, $folder->getSearchTypes());
        $this->assertSame($sortBy, $folder->getSortBy());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" query="$query" types="$searchTypes" sortBy="dateDesc" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($folder, 'xml'));
        $this->assertEquals($folder, $this->serializer->deserialize($xml, ModifySearchFolderSpec::class, 'xml'));
    }
}
