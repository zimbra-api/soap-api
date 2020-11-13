<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\CountObjectsType;

/**
 * Testcase class for CountObjectsType.
 */
class CountObjectsTypeTest extends TestCase
{
    public function testCountObjectsType()
    {
        $values = [
            'USER_ACCOUNT'               => 'userAccount',
            'ACCOUNT'                    => 'account',
            'ALIAS'                      => 'alias',
            'DL'                         => 'dl',
            'DOMAIN'                     => 'domain',
            'COS'                        => 'cos',
            'SERVER'                     => 'server',
            'CALRESOURCE'                => 'calresource',
            'ACCOUNT_ON_UCSERVICE'       => 'accountOnUCService',
            'COS_ON_UCSERVICE'           => 'cosOnUCService',
            'DOMAIN_ON_UCSERVICE'        => 'domainOnUCService',
            'INTERNAL_USER_ACCOUNT'      => 'internalUserAccount',
            'INTERNAL_ARCHIVING_ACCOUNT' => 'internalArchivingAccount',
            'INTERNAL_USER_ACCOUNT_X' => 'internalUserAccountX',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(CountObjectsType::$enum()->getValue(), $value);
        }
    }
}
