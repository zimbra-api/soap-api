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
 * DirectorySearchType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum DirectorySearchType: string
{
    /**
     * Constant for value 'accounts'
     * @return string 'accounts'
     */
    case ACCOUNTS = 'accounts';

    /**
     * Constant for value 'distributionlists'
     * @return string 'distributionlists'
     */
    case DISTRIBUTION_LISTS = 'distributionlists';

    /**
     * Constant for value 'aliases'
     * @return string 'aliases'
     */
    case ALIASES = 'aliases';

    /**
     * Constant for value 'resources'
     * @return string 'resources'
     */
    case RESOURCES = 'resources';

    /**
     * Constant for value 'domains'
     * @return string 'domains'
     */
    case DOMAINS = 'domains';

    /**
     * Constant for value 'coses'
     * @return string 'coses'
     */
    case COSES = 'coses';
}
