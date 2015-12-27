<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\QueueAction;

/**
 * Testcase class for QueueAction.
 */
class QueueActionTest extends PHPUnit_Framework_TestCase
{
    public function testQueueAction()
    {
        $values = [
            'HOLD'    => 'hold',
            'RELEASE' => 'release',
            'DELETE'  => 'delete',
            'REQUEUE' => 'requeue',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(QueueAction::$enum()->value(), $value);
        }
    }
}
