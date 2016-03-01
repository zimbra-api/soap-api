<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\DirectorySearchType;

/**
 * Testcase class for DirectorySearchType.
 */
class DirectorySearchTypeTest extends PHPUnit_Framework_TestCase
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
        foreach ($values as $enum => $value)
        {
            $this->assertSame(DirectorySearchType::$enum()->value(), $value);
        }
    }
}
