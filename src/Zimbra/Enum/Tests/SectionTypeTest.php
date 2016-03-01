<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\SectionType;

/**
 * Testcase class for SectionType.
 */
class SectionTypeTest extends PHPUnit_Framework_TestCase
{
    public function testSectionType()
    {
        $values = [
            'MBOX'     => 'mbox',
            'PREFS'    => 'prefs',
            'ATTRS'    => 'attrs',
            'ZIMLETS'  => 'zimlets',
            'PROPS'    => 'props',
            'IDENTS'   => 'idents',
            'SIGS'     => 'sigs',
            'DSRCS'    => 'dsrcs',
            'CHILDREN' => 'children',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(SectionType::$enum()->value(), $value);
        }
    }
}
