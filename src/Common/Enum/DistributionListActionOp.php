<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Enum;

use MyCLabs\Enum\Enum;

/**
 * DistributionListAction enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DistributionListActionOp extends Enum
{
    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    private const DELETE = 'delete';

    /**
     * Constant for value 'rename'
     * @return string 'rename'
     */
    private const RENAME = 'rename';

    /**
     * Constant for value 'modify'
     * @return string 'modify'
     */
    private const MODIFY = 'modify';

    /**
     * Constant for value 'addOwners'
     * @return string 'addOwners'
     */
    private const ADD_OWNERS = 'addOwners';

    /**
     * Constant for value 'removeOwners'
     * @return string 'removeOwners'
     */
    private const REMOVE_OWNERS = 'removeOwners';

    /**
     * Constant for value 'setOwners'
     * @return string 'setOwners'
     */
    private const SET_OWNERS = 'setOwners';

    /**
     * Constant for value 'grantRights'
     * @return string 'grantRights'
     */
    private const GRANT_RIGHTS = 'grantRights';

    /**
     * Constant for value 'revokeRights'
     * @return string 'revokeRights'
     */
    private const REVOKE_RIGHTS = 'revokeRights';

    /**
     * Constant for value 'setRights'
     * @return string 'setRights'
     */
    private const SET_RIGHTS = 'setRights';

    /**
     * Constant for value 'addMembers'
     * @return string 'addMembers'
     */
    private const ADD_MEMBERS = 'addMembers';

    /**
     * Constant for value 'removeMembers'
     * @return string 'removeMembers'
     */
    private const REMOVE_MEMBERS = 'removeMembers';

    /**
     * Constant for value 'acceptSubsReq'
     * @return string 'acceptSubsReq'
     */
    private const ACCEPT_SUBSREQ = 'acceptSubsReq';

    /**
     * Constant for value 'rejectSubsReq'
     * @return string 'rejectSubsReq'
     */
    private const REJECT_SUBSREQ = 'rejectSubsReq';
}
