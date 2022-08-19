<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\QueueAction;

/**
 * Testcase class for QueueAction.
 */
class QueueActionTest extends TestCase
{
    public function testQueueAction()
    {
        $values = [
            'HOLD'    => 'hold',
            'RELEASE' => 'release',
            'DELETE'  => 'delete',
            'REQUEUE' => 'requeue',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(QueueAction::$enum()->getValue(), $value);
        }
    }
}
