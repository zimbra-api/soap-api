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
 * NameIdBy enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class NameIdBy extends Base
{
    /**
     * Constant for value 'id'
     * @return string 'id'
     */
    const ID = 'id';

    /**
     * Constant for value 'name'
     * @return string 'name'
     */
    const NAME = 'name';
}
