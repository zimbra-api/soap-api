<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\CosBy;

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
        foreach ($values as $enum => $value) {
            $this->assertSame(CosBy::$enum()->getValue(), $value);
        }
    }
}
