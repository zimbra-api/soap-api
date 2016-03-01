<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\ConvActionOp;

/**
 * Testcase class for ConvActionOp.
 */
class ConvActionOpTest extends PHPUnit_Framework_TestCase
{
    public function testConvActionOp()
    {
        $values = [
            'DELETE'   => 'delete',
            'READ'     => 'read',
            'FLAG'     => 'flag',
            'PRIORITY' => 'priority',
            'TAG'      => 'tag',
            'MOVE'     => 'move',
            'SPAM'     => 'spam',
            'TRASH'    => 'trash',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(ConvActionOp::$enum()->value(), $value);
        }
    }
}
