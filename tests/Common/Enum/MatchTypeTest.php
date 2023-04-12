<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\MatchType;

/**
 * Testcase class for MatchType.
 */
class MatchTypeTest extends TestCase
{
    public function testMatchType()
    {
        $values = [
            'IS' =>    'is',
            'CONTAINS' => 'contains',
            'MATCHES'  => 'matches',
            'COUNT'  => 'count',
            'VALUE'  => 'value',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(MatchType::from($value)->name, $name);
            $this->assertSame(MatchType::from($value)->value, $value);
        }
    }
}
