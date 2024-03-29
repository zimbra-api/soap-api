<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\CosBy;

/**
 * Testcase class for CosBy.
 */
class CosByTest extends TestCase
{
    public function testCosBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(CosBy::from($value)->name, $name);
            $this->assertSame(CosBy::from($value)->value, $value);
        }
    }
}
