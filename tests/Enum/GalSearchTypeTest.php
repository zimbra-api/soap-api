<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\GalSearchType;

/**
 * Testcase class for GalSearchType.
 */
class GalSearchTypeTest extends TestCase
{
    public function testGalSearchType()
    {
        $values = [
            'ALL'      => 'all',
            'ACCOUNT'  => 'account',
            'RESOURCE' => 'resource',
            'GROUP'    => 'group',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(GalSearchType::$enum()->getValue(), $value);
        }
    }
}
