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
 * DirectorySearchType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DirectorySearchType extends Enum
{
    /**
     * Constant for value 'accounts'
     * @return string 'accounts'
     */
    protected const ACCOUNTS = 'accounts';

    /**
     * Constant for value 'distributionlists'
     * @return string 'distributionlists'
     */
    protected const DISTRIBUTION_LISTS = 'distributionlists';

    /**
     * Constant for value 'aliases'
     * @return string 'aliases'
     */
    protected const ALIASES = 'aliases';

    /**
     * Constant for value 'resources'
     * @return string 'resources'
     */
    protected const RESOURCES = 'resources';

    /**
     * Constant for value 'domains'
     * @return string 'domains'
     */
    protected const DOMAINS = 'domains';

    /**
     * Constant for value 'coses'
     * @return string 'coses'
     */
    protected const COSES = 'coses';
}
