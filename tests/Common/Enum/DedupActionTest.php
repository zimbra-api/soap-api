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
        foreach ($values as $name => $value) {
            $this->assertSame(DedupAction::from($value)->name, $name);
            $this->assertSame(DedupAction::from($value)->value, $value);
        }
    }
}
