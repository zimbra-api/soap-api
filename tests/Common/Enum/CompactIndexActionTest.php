<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\CompactIndexAction;

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
        foreach ($values as $name => $value) {
            $this->assertSame(CompactIndexAction::from($value)->name, $name);
            $this->assertSame(CompactIndexAction::from($value)->value, $value);
        }
    }
}
