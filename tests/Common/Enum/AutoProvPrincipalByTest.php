<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\AutoProvPrincipalBy;

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
        foreach ($values as $enum => $value) {
            $this->assertSame(AutoProvPrincipalBy::$enum()->getValue(), $value);
        }
    }
}