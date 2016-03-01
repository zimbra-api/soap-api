<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\VersionCheckAction;

/**
 * Testcase class for VersionCheckAction.
 */
class VersionCheckActionTest extends PHPUnit_Framework_TestCase
{
    public function testVersionCheckAction()
    {
        $values = [
            'CHECK'  => 'check',
            'STATUS' => 'status',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(VersionCheckAction::$enum()->value(), $value);
        }
    }
}
