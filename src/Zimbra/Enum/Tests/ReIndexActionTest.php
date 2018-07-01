<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\ReIndexAction;

/**
 * Testcase class for ReIndexAction.
 */
class ReIndexActionTest extends TestCase
{
    public function testReIndexAction()
    {
        $values = [
            'START'  => 'start',
            'STATUS' => 'status',
            'CANCEL' => 'cancel',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(ReIndexAction::$enum()->value(), $value);
        }
    }
}
