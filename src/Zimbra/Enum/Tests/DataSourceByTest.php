<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\DataSourceBy;

/**
 * Testcase class for DataSourceBy.
 */
class DataSourceByTest extends PHPUnit_Framework_TestCase
{
    public function testDataSourceBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(DataSourceBy::$enum()->value(), $value);
        }
    }
}
