<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ZimletExcludeType;

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
        foreach ($values as $name => $value) {
            $this->assertSame(ZimletExcludeType::from($value)->value, $value);
            $this->assertSame(ZimletExcludeType::from($value)->name, $name);
        }
    }
}
