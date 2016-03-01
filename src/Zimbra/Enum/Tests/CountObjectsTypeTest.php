<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\CountObjectsType;

/**
 * Testcase class for CountObjectsType.
 */
class CountObjectsTypeTest extends PHPUnit_Framework_TestCase
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
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(CountObjectsType::$enum()->value(), $value);
        }
    }
}
