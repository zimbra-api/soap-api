<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\VoiceSortBy;

/**
 * Testcase class for VoiceSortBy.
 */
class VoiceSortByTest extends PHPUnit_Framework_TestCase
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
        foreach ($values as $enum => $value)
        {
            $this->assertSame(VoiceSortBy::$enum()->value(), $value);
        }
    }
}
