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
 * MemberType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MemberType extends Enum
{
    /**
     * Constant for value 'contact'
     * @return string 'C'
     */
    private const CONTACT = 'C';

    /**
     * Constant for value 'GAL entry'
     * @return string 'deny'
     */
    private const GAL_ENTRY = 'G';

    /**
     * Constant for value 'inlined member'
     * @return string 'I'
     */
    private const INLINED_MEMBER = 'I';
}
