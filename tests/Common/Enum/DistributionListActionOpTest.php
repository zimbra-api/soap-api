<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\DistributionListActionOp;

/**
 * Testcase class for DistributionListActionOp.
 */
class DistributionListActionOpTest extends TestCase
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
        foreach ($values as $name => $value) {
            $this->assertSame(DistributionListActionOp::from($value)->name, $name);
            $this->assertSame(DistributionListActionOp::from($value)->value, $value);
        }
    }
}
