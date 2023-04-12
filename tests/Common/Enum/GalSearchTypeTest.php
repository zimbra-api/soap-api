<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\GalSearchType;

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
        foreach ($values as $name => $value) {
            $this->assertSame(GalSearchType::from($value)->name, $name);
            $this->assertSame(GalSearchType::from($value)->value, $value);
        }
    }
}
