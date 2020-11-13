<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\SearchType;

/**
 * Testcase class for SearchType.
 */
class SearchTypeTest extends TestCase
{
    public function testSearchType()
    {
        $values = [
            'CONVERSATION' => 'conversation',
            'MESSAGE'      => 'message',
            'CONTACT'      => 'contact',
            'APPOINTMENT'  => 'appointment',
            'TASK'         => 'task',
            'WIKI'         => 'wiki',
            'DOCUMENT'     => 'document',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(SearchType::$enum()->getValue(), $value);
        }
    }
}
