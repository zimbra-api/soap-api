<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\Importance;

/**
 * Testcase class for Importance.
 */
class ImportanceTest extends PHPUnit_Framework_TestCase
{
    public function testImportance()
    {
        $values = [
            'HIGH'   => 'high',
            'NORMAL' => 'normal',
            'LOW'    => 'low',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(Importance::$enum()->value(), $value);
        }
    }
}
