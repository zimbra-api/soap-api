<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\Importance;

/**
 * Testcase class for Importance.
 */
class ImportanceTest extends TestCase
{
    public function testImportance()
    {
        $values = [
            'HIGH'   => 'high',
            'NORMAL' => 'normal',
            'LOW'    => 'low',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(Importance::$enum()->getValue(), $value);
        }
    }
}
