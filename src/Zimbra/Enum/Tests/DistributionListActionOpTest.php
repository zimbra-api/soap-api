<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\DistributionListActionOp;

/**
 * Testcase class for DistributionListActionOp.
 */
class DistributionListActionOpTest extends PHPUnit_Framework_TestCase
{
    public function testDistributionListActionOp()
    {
        $values = [
            'DELETE'         => 'delete',
            'RENAME'         => 'rename',
            'MODIFY'         => 'modify',
            'ADD_OWNERS'     => 'addOwners',
            'REMOVE_OWNERS'  => 'removeOwners',
            'SET_OWNERS'     => 'setOwners',
            'GRANT_RIGHTS'   => 'grantRights',
            'REVOKE_RIGHTS'  => 'revokeRights',
            'SET_RIGHTS'     => 'setRights',
            'ADD_MEMBERS'    => 'addMembers',
            'REMOVE_MEMBERS' => 'removeMembers',
            'ACCEPT_SUBSREQ' => 'acceptSubsReq',
            'REJECT_SUBSREQ' => 'rejectSubsReq',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(DistributionListActionOp::$enum()->value(), $value);
        }
    }
}
