<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\ItemActionOp;

/**
 * Testcase class for ItemActionOp.
 */
class ItemActionOpTest extends PHPUnit_Framework_TestCase
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
        foreach ($values as $enum => $value)
        {
            $this->assertSame(ItemActionOp::$enum()->value(), $value);
        }
    }
}
