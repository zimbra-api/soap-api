<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\DataSourceType;

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
        foreach ($values as $name => $value) {
            $this->assertSame(DataSourceType::from($value)->name, $name);
            $this->assertSame(DataSourceType::from($value)->value, $value);
        }
    }
}
