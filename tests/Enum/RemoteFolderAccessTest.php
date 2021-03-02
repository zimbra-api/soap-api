<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\RemoteFolderAccess;

/**
 * Testcase class for RemoteFolderAccess.
 */
class RemoteFolderAccessTest extends TestCase
{
    public function testRemoteFolderAccess()
    {
        $values = [
            'CREATE' => 'c',
            'INSERT' => 'i',
            'READ'   => 'r',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(RemoteFolderAccess::$enum()->getValue(), $value);
        }
    }
}
