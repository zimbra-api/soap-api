<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\DataSourceBy;

/**
 * Testcase class for DataSourceBy.
 */
class DataSourceByTest extends TestCase
{
    public function testDataSourceBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(DataSourceBy::$enum()->getValue(), $value);
        }
    }
}
