<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\CompactIndexAction;

/**
 * Testcase class for CompactIndexAction.
 */
class CompactIndexActionTest extends TestCase
{
    public function testCompactIndexAction()
    {
        $values = [
            'START'  => 'start',
            'STATUS' => 'status',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(CompactIndexAction::$enum()->value(), $value);
        }
    }
}
