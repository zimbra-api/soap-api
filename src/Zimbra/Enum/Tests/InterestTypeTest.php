<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\InterestType;

/**
 * Testcase class for InterestType.
 */
class InterestTypeTest extends TestCase
{
    public function testInterestType()
    {
        $values = [
            'FOLDERS'      => 'f',
            'MESSAGES'     => 'm',
            'CONTACTS'     => 'c',
            'APPOINTMENTS' => 'a',
            'TASKS'        => 't',
            'DOCUMENTS'    => 'd',
            'ALL'          => 'all',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(InterestType::$enum()->getValue(), $value);
        }
    }
}
