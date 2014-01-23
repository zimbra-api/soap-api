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
 * DistributionListSubscribeOp enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DistributionListSubscribeOp extends Base
{
    /**
     * Constant for value 'subscribe'
     * @return string 'subscribe'
     */
    const SUBSCRIBE = 'subscribe';

    /**
     * Constant for value 'unsubscribe'
     * @return string 'unsubscribe'
     */
    const UNSUBSCRIBE = 'unsubscribe';
}
