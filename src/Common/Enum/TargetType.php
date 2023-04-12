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
 * EnumTargetType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum TargetType: string
{
    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    case ACCOUNT = 'account';

    /**
     * Constant for value 'calresource'
     * @return string 'calresource'
     */
    case CALRESOURCE = 'calresource';

    /**
     * Constant for value 'cos'
     * @return string 'cos'
     */
    case COS = 'cos';

    /**
     * Constant for value 'dl'
     * @return string 'dl'
     */
    case DL = 'dl';

    /**
     * Constant for value 'group'
     * @return string 'group'
     */
    case GROUP = 'group';

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    case DOMAIN = 'domain';

    /**
     * Constant for value 'server'
     * @return string 'server'
     */
    case SERVER = 'server';

    /**
     * Constant for value 'alwaysoncluster'
     * @return string 'alwaysoncluster'
     */
    case ALWAYSONCLUSTER = 'alwaysoncluster';

    /**
     * Constant for value 'ucservice'
     * @return string 'ucservice'
     */
    case UCSERVICE = 'ucservice';

    /**
     * Constant for value 'xmppcomponent'
     * @return string 'xmppcomponent'
     */
    case XMPPCOMPONENT = 'xmppcomponent';

    /**
     * Constant for value 'zimlet'
     * @return string 'zimlet'
     */
    case ZIMLET = 'zimlet';

    /**
     * Constant for value 'config'
     * @return string 'config'
     */
    case CONFIG = 'config';

    /**
     * Constant for value 'global'
     * @return string 'global'
     */
    case GLOBALTYPE = 'global';
}
