<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\GranteeBy;

/**
 * Testcase class for GranteeBy.
 */
class GranteeByTest extends PHPUnit_Framework_TestCase
{
    public function testGranteeBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(GranteeBy::$enum()->value(), $value);
        }
    }
}
