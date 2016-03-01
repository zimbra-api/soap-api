<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\ZimletExcludeType;

/**
 * Testcase class for ZimletExcludeType.
 */
class ZimletExcludeTypeTest extends PHPUnit_Framework_TestCase
{
    public function testZimletExcludeType()
    {
        $values = [
            'EXTENSION' => 'extension',
            'MAIL'      => 'mail',
            'NONE'      => 'none',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(ZimletExcludeType::$enum()->value(), $value);
        }
    }
}
