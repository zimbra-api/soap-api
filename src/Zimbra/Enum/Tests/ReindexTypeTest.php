<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\ReindexType;

/**
 * Testcase class for ReindexType.
 */
class ReindexTypeTest extends PHPUnit_Framework_TestCase
{
    public function testReindexType()
    {
        $values = [
            'CONVERSATION' => 'conversation',
            'MESSAGE'      => 'message',
            'CONTACT'      => 'contact',
            'APPOINTMENT'  => 'appointment',
            'TASK'         => 'task',
            'NOTE'         => 'note',
            'WIKI'         => 'wiki',
            'DOCUMENT'     => 'document',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(ReindexType::$enum()->value(), $value);
        }
    }
}
