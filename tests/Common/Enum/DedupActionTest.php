<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\DedupAction;

/**
 * Testcase class for DedupAction.
 */
class DedupActionTest extends TestCase
{
    public function testDedupAction()
    {
        $values = [
            'START'  => 'start',
            'STATUS' => 'status',
            'STOP'   => 'stop',
            'RESET'  => 'reset',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(DedupAction::$enum()->getValue(), $value);
        }
    }
}
