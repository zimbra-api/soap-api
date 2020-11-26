<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\DataSourceType;

/**
 * Testcase class for DataSourceType.
 */
class DataSourceTypeTest extends TestCase
{
    public function testDataSourceType()
    {
        $values = [
            'POP3'     => 'pop3',
            'IMAP'     => 'imap',
            'CALDAV'   => 'caldav',
            'CONTACTS' => 'contacts',
            'YAB'      => 'yab',
            'RSS'      => 'rss',
            'CAL'      => 'cal',
            'GAL'      => 'gal',
            'XSYNC'    => 'xsync',
            'TAGMAP'   => 'tagmap',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(DataSourceType::$enum()->getValue(), $value);
        }
    }
}
