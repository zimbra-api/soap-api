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
 * MemberType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class MemberType extends Base
{
    /**
     * Constant for value 'contact'
     * @return string 'C'
     */
    const CONTACT = 'C';

    /**
     * Constant for value 'GAL entry'
     * @return string 'deny'
     */
    const GAL_ENTRY = 'G';

    /**
     * Constant for value 'inlined member'
     * @return string 'I'
     */
    const INLINED_MEMBER = 'I';
}
