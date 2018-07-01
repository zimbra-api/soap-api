<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\AutoProvPrincipalBy;

/**
 * Testcase class for AutoProvPrincipalBy.
 */
class AutoProvPrincipalByTest extends TestCase
{
    public function testAutoProvPrincipalBy()
    {
        $values = [
            'DN'   => 'dn',
            'NAME' => 'name',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(AutoProvPrincipalBy::$enum()->value(), $value);
        }
    }
}
