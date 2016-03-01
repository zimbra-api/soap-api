<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\VoiceMsgActionOp;

/**
 * Testcase class for VoiceMsgActionOp.
 */
class VoiceMsgActionOpTest extends PHPUnit_Framework_TestCase
{
    public function testVoiceMsgActionOp()
    {
        $values = [
            'MOVE'     => 'move',
            'READ'     => 'read',
            'NOT_READ' => '!read',
            'IS_EMPTY' => 'empty',
            'DELETE'   => 'delete',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(VoiceMsgActionOp::$enum()->value(), $value);
        }
    }
}
