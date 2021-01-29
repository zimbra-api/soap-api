<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\ZimletExcludeType;

/**
 * Testcase class for ZimletExcludeType.
 */
class ZimletExcludeTypeTest extends TestCase
{
    public function testZimletExcludeType()
    {
        $values = [
            'EXTENSION' => 'extension',
            'MAIL'      => 'mail',
            'NONE'      => 'none',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(ZimletExcludeType::$enum()->getValue(), $value);
        }
    }
}
