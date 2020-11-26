<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\MsgActionOp;

/**
 * Testcase class for MsgActionOp.
 */
class MsgActionOpTest extends TestCase
{
    public function testMsgActionOp()
    {
        $values = [
            'DELETE' => 'delete',
            'READ'   => 'read',
            'FLAG'   => 'flag',
            'TAG'    => 'tag',
            'MOVE'   => 'move',
            'UPDATE' => 'update',
            'SPAM'   => 'spam',
            'TRASH'  => 'trash',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(MsgActionOp::$enum()->getValue(), $value);
        }
    }
}
