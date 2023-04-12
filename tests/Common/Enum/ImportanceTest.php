<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\Importance;

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
        foreach ($values as $name => $value) {
            $this->assertSame(Importance::from($value)->name, $name);
            $this->assertSame(Importance::from($value)->value, $value);
        }
    }
}
