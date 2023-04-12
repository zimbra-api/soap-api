<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\VoiceSortBy;

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
        foreach ($values as $name => $value) {
            $this->assertSame(VoiceSortBy::from($value)->value, $value);
            $this->assertSame(VoiceSortBy::from($value)->name, $name);
        }
    }
}
