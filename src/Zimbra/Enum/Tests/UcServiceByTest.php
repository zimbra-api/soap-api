<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\UcServiceBy;

/**
 * Testcase class for UcServiceBy.
 */
class UcServiceByTest extends PHPUnit_Framework_TestCase
{
    public function testUcServiceBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(UcServiceBy::$enum()->value(), $value);
        }
    }
}
