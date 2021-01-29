<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\DirectorySearchType;

/**
 * Testcase class for DirectorySearchType.
 */
class DirectorySearchTypeTest extends TestCase
{
    public function testDirectorySearchType()
    {
        $values = [
            'ACCOUNTS'           => 'accounts',
            'DISTRIBUTION_LISTS' => 'distributionlists',
            'ALIASES'            => 'aliases',
            'RESOURCES'          => 'resources',
            'DOMAINS'            => 'domains',
            'COSES'              => 'coses',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(DirectorySearchType::$enum()->getValue(), $value);
        }
    }
}
