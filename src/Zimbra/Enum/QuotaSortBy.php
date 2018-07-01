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
 * QuotaSortBy enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class QuotaSortBy extends Base
{
    /**
     * Constant for value 'percentUsed'
     * @return string 'percentUsed'
     */
    const PERCENT_USED = 'percentUsed';

    /**
     * Constant for value 'totalUsed'
     * @return string 'totalUsed'
     */
    const TOTAL_USED = 'totalUsed';

    /**
     * Constant for value 'quotaLimit'
     * @return string 'quotaLimit'
     */
    const QUOTA_LIMIT = 'quotaLimit';
}
