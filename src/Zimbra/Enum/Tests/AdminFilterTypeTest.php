<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\AdminFilterType;

/**
 * Testcase class for AdminFilterType.
 */
class AdminFilterTypeTest extends TestCase
{
    public function testAdminFilterType()
    {
        $values = [
            'BEFORE'   => 'before',
            'AFTER' => 'after',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(AdminFilterType::$enum()->getValue(), $value);
        }
    }
}
