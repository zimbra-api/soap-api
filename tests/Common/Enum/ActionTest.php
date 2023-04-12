<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\Action;

/**
 * Testcase class for Action.
 */
class ActionTest extends TestCase
{
    public function testAction()
    {
        $values = [
            'EDIT'   => 'edit',
            'REVOKE' => 'revoke',
            'EXPIRE' => 'expire',
            'START'  => 'start',
            'STATUS' => 'status',
            'STOP'   => 'stop',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(Action::from($value)->name, $name);
            $this->assertSame(Action::from($value)->value, $value);
        }
    }
}
