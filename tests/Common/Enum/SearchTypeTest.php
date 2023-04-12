<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\SearchType;

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
        foreach ($values as $name => $value) {
            $this->assertSame(SearchType::from($value)->name, $name);
            $this->assertSame(SearchType::from($value)->value, $value);
        }
    }
}
