<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ItemType;

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
        foreach ($values as $name => $value) {
            $this->assertSame(ItemType::from($value)->name, $name);
            $this->assertSame(ItemType::from($value)->value, $value);
        }
    }
}
