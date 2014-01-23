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
 * ExcludeType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ZimletExcludeType extends Base
{
    /**
     * Constant for value 'extension'
     * @return string 'extension'
     */
    const EXTENSION = 'extension';

    /**
     * Constant for value 'mail'
     * @return string 'mail'
     */
    const MAIL = 'mail';

    /**
     * Constant for value 'none'
     * @return string 'none'
     */
    const NONE = 'none';
}
