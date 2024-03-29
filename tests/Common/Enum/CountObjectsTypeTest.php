<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\CountObjectsType;

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
            'INTERNAL_USER_ACCOUNT_X'    => 'internalUserAccountX',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(CountObjectsType::from($value)->name, $name);
            $this->assertSame(CountObjectsType::from($value)->value, $value);
        }
    }
}
