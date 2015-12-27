<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\BrowseBy;

/**
 * Testcase class for BrowseBy.
 */
class BrowseByTest extends PHPUnit_Framework_TestCase
{
    public function testBrowseBy()
    {
        $values = [
            'DOMAINS'     => 'domains',
            'ATTACHMENTS' => 'attachments',
            'OBJECTS'     => 'objects',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(BrowseBy::$enum()->value(), $value);
        }
    }
}
