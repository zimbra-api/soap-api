<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ReIndexAction;

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
        foreach ($values as $name => $value) {
            $this->assertSame(ReIndexAction::from($value)->name, $name);
            $this->assertSame(ReIndexAction::from($value)->value, $value);
        }
    }
}
