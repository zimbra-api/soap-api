<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\VoiceSortBy;

/**
 * Testcase class for VoiceSortBy.
 */
class VoiceSortByTest extends TestCase
{
    public function testVoiceSortBy()
    {
        $values = [
            'DATE_DESC' => 'dateDesc',
            'DATE_ASC'  => 'dateAsc',
            'DUR_DESC'  => 'durDesc',
            'DUR_ASC'   => 'durAsc',
            'NAME_DESC' => 'nameDesc',
            'NAME_ASC'  => 'nameAsc',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(VoiceSortBy::$enum()->getValue(), $value);
        }
    }
}
