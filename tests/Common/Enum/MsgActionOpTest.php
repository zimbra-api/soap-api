<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\MsgActionOp;

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
        foreach ($values as $name => $value) {
            $this->assertSame(MsgActionOp::from($value)->name, $name);
            $this->assertSame(MsgActionOp::from($value)->value, $value);
        }
    }
}
