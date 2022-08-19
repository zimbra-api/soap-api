<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\GetSessionsSortBy;

/**
 * Testcase class for GetSessionsSortBy.
 */
class GetSessionsSortByTest extends TestCase
{
    public function testGetSessionsSortBy()
    {
        $values = [
            'NAME_ASC'      => 'nameAsc',
            'NAME_DESC'     => 'nameDesc',
            'CREATED_ASC'   => 'createdAsc',
            'CREATED_DESC'  => 'createdDesc',
            'ACCESSED_ASC'  => 'accessedAsc',
            'ACCESSED_DESC' => 'accessedDesc',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(GetSessionsSortBy::$enum()->getValue(), $value);
        }
    }
}
