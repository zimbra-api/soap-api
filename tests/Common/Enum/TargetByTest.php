<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\TargetBy;

/**
 * Testcase class for TargetBy.
 */
class TargetByTest extends TestCase
{
    public function testTargetBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(TargetBy::from($value)->name, $name);
            $this->assertSame(TargetBy::from($value)->value, $value);
        }
    }
}
