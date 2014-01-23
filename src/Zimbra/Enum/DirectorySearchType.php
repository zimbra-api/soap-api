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
 * DirectorySearchType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DirectorySearchType extends Base
{
    /**
     * Constant for value 'accounts'
     * @return string 'accounts'
     */
    const ACCOUNTS = 'accounts';

    /**
     * Constant for value 'distributionlists'
     * @return string 'distributionlists'
     */
    const DISTRIBUTION_LISTS = 'distributionlists';

    /**
     * Constant for value 'aliases'
     * @return string 'aliases'
     */
    const ALIASES = 'aliases';

    /**
     * Constant for value 'resources'
     * @return string 'resources'
     */
    const RESOURCES = 'resources';

    /**
     * Constant for value 'domains'
     * @return string 'domains'
     */
    const DOMAINS = 'domains';

    /**
     * Constant for value 'coses'
     * @return string 'coses'
     */
    const COSES = 'coses';
}
