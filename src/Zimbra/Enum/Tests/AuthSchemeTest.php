<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\AuthScheme;

/**
 * Testcase class for AuthScheme.
 */
class AuthSchemeTest extends PHPUnit_Framework_TestCase
{
    public function testAuthScheme()
    {
        $values = [
            'BASIC' => 'basic',
            'FORM'  => 'form',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(AuthScheme::$enum()->value(), $value);
        }
    }
}
