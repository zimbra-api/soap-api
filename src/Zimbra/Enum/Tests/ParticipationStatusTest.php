<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\ParticipationStatus;

/**
 * Testcase class for ParticipationStatus.
 */
class ParticipationStatusTest extends PHPUnit_Framework_TestCase
{
    public function testParticipationStatus()
    {
        $values = [
            'NEEDS_ACTION' => 'NE',
            'ACCEPT'       => 'AC',
            'TENTATIVE'    => 'TE',
            'DECLINED'     => 'DE',
            'DELEGATED'    => 'DG',
            'COMPLETED'    => 'CO',
            'IN_PROCESS'   => 'IN',
            'WAITING'      => 'WE',
            'DEFERRED'     => 'DF',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(ParticipationStatus::$enum()->value(), $value);
        }
    }
}
