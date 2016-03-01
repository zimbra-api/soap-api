<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\NewSearchFolderSpec;

/**
 * Testcase class for NewSearchFolderSpec.
 */
class NewSearchFolderSpecTest extends ZimbraMailTestCase
{
    public function testNewSearchFolderSpec()
    {
        $name = $this->faker->word;
        $query = $this->faker->word;
        $types = $this->faker->word;
        $sortBy = $this->faker->word;
        $f = $this->faker->word;
        $l = $this->faker->word;
        $color = mt_rand(1, 127);

        $search = new NewSearchFolderSpec(
            $name, $query, $types, $sortBy, $f, $color, $l
        );
        $this->assertSame($name, $search->getName());
        $this->assertSame($query, $search->getQuery());
        $this->assertSame($types, $search->getSearchTypes());
        $this->assertSame($sortBy, $search->getSortBy());
        $this->assertSame($f, $search->getFlags());
        $this->assertSame($color, $search->getColor());
        $this->assertSame($l, $search->getParentFolderId());

        $search = new NewSearchFolderSpec('', '');
        $search->setName($name)
               ->setQuery($query)
               ->setSearchTypes($types)
               ->setSortBy($sortBy)
               ->setFlags($f)
               ->setColor($color)
               ->setParentFolderId($l);
        $this->assertSame($name, $search->getName());
        $this->assertSame($query, $search->getQuery());
        $this->assertSame($types, $search->getSearchTypes());
        $this->assertSame($sortBy, $search->getSortBy());
        $this->assertSame($f, $search->getFlags());
        $this->assertSame($color, $search->getColor());
        $this->assertSame($l, $search->getParentFolderId());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<search name="' . $name . '" query="' . $query . '" types="' . $types . '" sortBy="' . $sortBy . '" f="' . $f . '" color="' . $color . '" l="' . $l . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $search);

        $array = array(
            'search' => array(
                'name' => $name,
                'query' => $query,
                'types' => $types,
                'sortBy' => $sortBy,
                'f' => $f,
                'color' => $color,
                'l' => $l,
            ),
        );
        $this->assertEquals($array, $search->toArray());
    }
}
