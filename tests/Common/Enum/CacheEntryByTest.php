<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\CacheEntryBy;

/**
 * Testcase class for CacheEntryBy.
 */
class CacheEntryByTest extends TestCase
{
    public function testCacheEntryBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(CacheEntryBy::$enum()->getValue(), $value);
        }
    }
}
