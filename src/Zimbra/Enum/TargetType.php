<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Enum;

/**
 * EnumTargetType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TargetType extends Base
{
    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    const ACCOUNT = 'account';

    /**
     * Constant for value 'calresource'
     * @return string 'calresource'
     */
    const CALRESOURCE = 'calresource';

    /**
     * Constant for value 'cos'
     * @return string 'cos'
     */
    const COS = 'cos';

    /**
     * Constant for value 'dl'
     * @return string 'dl'
     */
    const DL = 'dl';

    /**
     * Constant for value 'group'
     * @return string 'group'
     */
    const GROUP = 'group';

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    const DOMAIN = 'domain';

    /**
     * Constant for value 'server'
     * @return string 'server'
     */
    const SERVER = 'server';

    /**
     * Constant for value 'alwaysoncluster'
     * @return string 'alwaysoncluster'
     */
    const ALWAYSONCLUSTER = 'alwaysoncluster';

    /**
     * Constant for value 'ucservice'
     * @return string 'ucservice'
     */
    const UCSERVICE = 'ucservice';

    /**
     * Constant for value 'xmppcomponent'
     * @return string 'xmppcomponent'
     */
    const XMPPCOMPONENT = 'xmppcomponent';

    /**
     * Constant for value 'zimlet'
     * @return string 'zimlet'
     */
    const ZIMLET = 'zimlet';

    /**
     * Constant for value 'config'
     * @return string 'config'
     */
    const CONFIG = 'config';

    /**
     * Constant for value 'global'
     * @return string 'global'
     */
    const GLOBALTYPE = 'global';
}
