<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\AuthScheme;

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
        foreach ($values as $name => $value) {
            $this->assertSame(AuthScheme::from($value)->name, $name);
            $this->assertSame(AuthScheme::from($value)->value, $value);
        }
    }
}
