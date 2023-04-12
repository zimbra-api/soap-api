<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ParticipationStatus;

/**
 * Testcase class for ParticipationStatus.
 */
class ParticipationStatusTest extends TestCase
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
        foreach ($values as $name => $value) {
            $this->assertSame(ParticipationStatus::from($value)->name, $name);
            $this->assertSame(ParticipationStatus::from($value)->value, $value);
        }
    }
}
