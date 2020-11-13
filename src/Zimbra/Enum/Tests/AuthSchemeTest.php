<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\AuthScheme;

/**
 * Testcase class for AuthScheme.
 */
class AuthSchemeTest extends TestCase
{
    public function testAuthScheme()
    {
        $values = [
            'BASIC' => 'basic',
            'FORM'  => 'form',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(AuthScheme::$enum()->getValue(), $value);
        }
    }
}
