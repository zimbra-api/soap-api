<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ModifySearchFolderSpec;

/**
 * Testcase class for ModifySearchFolderSpec.
 */
class ModifySearchFolderSpecTest extends ZimbraMailTestCase
{
    public function testModifySearchFolderSpec()
    {
        $id = $this->faker->uuid;
        $query = $this->faker->word;
        $types = $this->faker->word;
        $sortBy = $this->faker->word;

        $search = new ModifySearchFolderSpec(
            $id, $query, $types, $sortBy
        );
        $this->assertSame($id, $search->getId());
        $this->assertSame($query, $search->getQuery());
        $this->assertSame($types, $search->getSearchTypes());
        $this->assertSame($sortBy, $search->getSortBy());

        $search->setId($id)
               ->setQuery($query)
               ->setSearchTypes($types)
               ->setSortBy($sortBy);
        $this->assertSame($id, $search->getId());
        $this->assertSame($query, $search->getQuery());
        $this->assertSame($types, $search->getSearchTypes());
        $this->assertSame($sortBy, $search->getSortBy());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<search id="' . $id . '" query="' . $query . '" types="' . $types . '" sortBy="' . $sortBy . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $search);

        $array = array(
            'search' => array(
                'id' => $id,
                'query' => $query,
                'types' => $types,
                'sortBy' => $sortBy,
            ),
        );
        $this->assertEquals($array, $search->toArray());
    }
}
