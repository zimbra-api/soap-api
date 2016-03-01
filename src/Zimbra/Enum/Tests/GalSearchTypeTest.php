<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\GalSearchType;

/**
 * Testcase class for GalSearchType.
 */
class GalSearchTypeTest extends PHPUnit_Framework_TestCase
{
    public function testGalSearchType()
    {
        $values = [
            'ALL'      => 'all',
            'ACCOUNT'  => 'account',
            'RESOURCE' => 'resource',
            'GROUP'    => 'group',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(GalSearchType::$enum()->value(), $value);
        }
    }
}
