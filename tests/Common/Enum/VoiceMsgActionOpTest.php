<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\VoiceMsgActionOp;

/**
 * Testcase class for VoiceMsgActionOp.
 */
class VoiceMsgActionOpTest extends TestCase
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
        foreach ($values as $name => $value) {
            $this->assertSame(VoiceMsgActionOp::from($value)->value, $value);
            $this->assertSame(VoiceMsgActionOp::from($value)->name, $name);
        }
    }
}
