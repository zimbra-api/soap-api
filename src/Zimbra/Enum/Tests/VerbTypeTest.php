<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\VerbType;

/**
 * Testcase class for VerbType.
 */
class VerbTypeTest extends PHPUnit_Framework_TestCase
{
    public function testVerbType()
    {
        $values = [
            'ACCEPT'    => 'ACCEPT',
            'DECLINE'   => 'DECLINE',
            'TENTATIVE' => 'TENTATIVE',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(VerbType::$enum()->value(), $value);
        }
    }
}
