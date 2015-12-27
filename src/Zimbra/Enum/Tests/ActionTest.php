<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\Action;

/**
 * Testcase class for Action.
 */
class ActionTest extends PHPUnit_Framework_TestCase
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
        foreach ($values as $enum => $value)
        {
            $this->assertSame(Action::$enum()->value(), $value);
        }
    }
}
