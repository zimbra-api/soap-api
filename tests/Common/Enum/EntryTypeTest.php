<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\EntryType;

/**
 * Testcase class for EntryType.
 */
class EntryTypeTest extends TestCase
{
    public function testEntryType()
    {
        $values = [
            'ACCOUNT'           => 'account',
            'ALIAS'             => 'alias',
            'DISTRIBUTION_LIST' => 'distributionList',
            'COS'               => 'cos',
            'GLOBAL_CONFIG'     => 'globalConfig',
            'DOMAIN'            => 'domain',
            'SERVER'            => 'server',
            'MIME_ENTRY'        => 'mimeEntry',
            'ZIMLET_ENTRY'      => 'zimletEntry',
            'CALENDAR_RESOURCE' => 'calendarResource',
            'IDENTITY'          => 'identity',
            'DATA_SOURCE'       => 'dataSource',
            'POP3_DATA_SOURCE'  => 'pop3DataSource',
            'IMAP_DATA_SOURCE'  => 'imapDataSource',
            'RSS_DATA_SOURCE'   => 'rssDataSource',
            'LIVE_DATA_SOURCE'  => 'liveDataSource',
            'GAL_DATA_SOURCE'   => 'galDataSource',
            'SIGNATURE'         => 'signature',
            'XMPP_COMPONENT'    => 'xmppComponent',
            'ACL_TARGET'        => 'aclTarget',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(EntryType::$enum()->getValue(), $value);
        }
    }
}
