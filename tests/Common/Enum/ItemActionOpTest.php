<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ItemActionOp;

/**
 * Testcase class for ItemActionOp.
 */
class ItemActionOpTest extends TestCase
{
    public function testItemActionOp()
    {
        $values = [
            'DELETE'          => 'delete',
            'DUMPSTER_DELETE' => 'dumpsterdelete',
            'RECOVER'         => 'recover',
            'READ'            => 'read',
            'FLAG'            => 'flag',
            'PRIORITY'        => 'priority',
            'TAG'             => 'tag',
            'MOVE'            => 'move',
            'TRASH'           => 'trash',
            'RENAME'          => 'rename',
            'UPDATE'          => 'update',
            'COLOR'           => 'color',
            'LOCK'            => 'lock',
            'UNLOCK'          => 'unlock',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(ItemActionOp::from($value)->name, $name);
            $this->assertSame(ItemActionOp::from($value)->value, $value);
        }
    }
}
