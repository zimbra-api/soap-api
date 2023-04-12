<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\UcServiceBy;

/**
 * Testcase class for UcServiceBy.
 */
class UcServiceByTest extends TestCase
{
    public function testUcServiceBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(UcServiceBy::from($value)->value, $value);
            $this->assertSame(UcServiceBy::from($value)->name, $name);
        }
    }
}
