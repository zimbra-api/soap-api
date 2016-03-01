<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\CompactIndexAction;

/**
 * Testcase class for CompactIndexAction.
 */
class CompactIndexActionTest extends PHPUnit_Framework_TestCase
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
