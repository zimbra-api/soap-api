<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\ItemType;

/**
 * Testcase class for ItemType.
 */
class ItemTypeTest extends TestCase
{
    public function testItemType()
    {
        $values = [
            'APPOINTMENT'  => 'appointment',
            'CHAT'         => 'chat',
            'CONTACT'      => 'contact',
            'CONVERSATION' => 'conversation',
            'DOCUMENT'     => 'document',
            'MESSAGE'      => 'message',
            'TAG'          => 'tag',
            'TASK'         => 'task',
            'WIKI'         => 'wiki',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(ItemType::$enum()->getValue(), $value);
        }
    }
}
