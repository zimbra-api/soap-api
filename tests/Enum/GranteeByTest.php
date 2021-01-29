<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\GranteeBy;

/**
 * Testcase class for GranteeBy.
 */
class GranteeByTest extends TestCase
{
    public function testGranteeBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(GranteeBy::$enum()->getValue(), $value);
        }
    }
}
