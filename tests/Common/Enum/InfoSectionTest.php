<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\InfoSection;

/**
 * Testcase class for InfoSection.
 */
class InfoSectionTest extends TestCase
{
    public function testInfoSection()
    {
        $values = [
            'MBOX'   => 'mbox',
            'PREFS' => 'prefs',
            'ATTRS' => 'attrs',
            'ZIMLETS'  => 'zimlets',
            'PROPS' => 'props',
            'IDENTS'   => 'idents',
            'SIGS'   => 'sigs',
            'DSRCS'   => 'dsrcs',
            'CHILDREN'   => 'children',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(InfoSection::from($value)->name, $name);
            $this->assertSame(InfoSection::from($value)->value, $value);
        }
    }
}
