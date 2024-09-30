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

/**
 * DistributionListAction enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum DistributionListActionOp: string
{
    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    case DELETE = "delete";

    /**
     * Constant for value 'rename'
     * @return string 'rename'
     */
    case RENAME = "rename";

    /**
     * Constant for value 'modify'
     * @return string 'modify'
     */
    case MODIFY = "modify";

    /**
     * Constant for value 'addOwners'
     * @return string 'addOwners'
     */
    case ADD_OWNERS = "addOwners";

    /**
     * Constant for value 'removeOwners'
     * @return string 'removeOwners'
     */
    case REMOVE_OWNERS = "removeOwners";

    /**
     * Constant for value 'setOwners'
     * @return string 'setOwners'
     */
    case SET_OWNERS = "setOwners";

    /**
     * Constant for value 'grantRights'
     * @return string 'grantRights'
     */
    case GRANT_RIGHTS = "grantRights";

    /**
     * Constant for value 'revokeRights'
     * @return string 'revokeRights'
     */
    case REVOKE_RIGHTS = "revokeRights";

    /**
     * Constant for value 'setRights'
     * @return string 'setRights'
     */
    case SET_RIGHTS = "setRights";

    /**
     * Constant for value 'addMembers'
     * @return string 'addMembers'
     */
    case ADD_MEMBERS = "addMembers";

    /**
     * Constant for value 'removeMembers'
     * @return string 'removeMembers'
     */
    case REMOVE_MEMBERS = "removeMembers";

    /**
     * Constant for value 'acceptSubsReq'
     * @return string 'acceptSubsReq'
     */
    case ACCEPT_SUBSREQ = "acceptSubsReq";

    /**
     * Constant for value 'rejectSubsReq'
     * @return string 'rejectSubsReq'
     */
    case REJECT_SUBSREQ = "rejectSubsReq";
}
