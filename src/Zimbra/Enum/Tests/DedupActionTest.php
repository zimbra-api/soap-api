<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\DedupAction;

/**
 * Testcase class for DedupAction.
 */
class DedupActionTest extends PHPUnit_Framework_TestCase
{
    public function testDedupAction()
    {
        $values = [
            'START'  => 'start',
            'STATUS' => 'status',
            'STOP'   => 'stop',
            'RESET'  => 'reset',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(DedupAction::$enum()->value(), $value);
        }
    }
}
