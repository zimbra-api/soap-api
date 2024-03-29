<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ReindexType;

/**
 * Testcase class for ReindexType.
 */
class ReindexTypeTest extends TestCase
{
    public function testReindexType()
    {
        $values = [
            'CONVERSATION' => 'conversation',
            'MESSAGE'      => 'message',
            'CONTACT'      => 'contact',
            'APPOINTMENT'  => 'appointment',
            'TASK'         => 'task',
            'NOTE'         => 'note',
            'WIKI'         => 'wiki',
            'DOCUMENT'     => 'document',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(ReindexType::from($value)->name, $name);
            $this->assertSame(ReindexType::from($value)->value, $value);
        }
    }
}
