<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Enum;

use MyCLabs\Enum\Enum;

/**
 * DocumentGrantType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DocumentGrantType extends Enum
{
    /**
     * Constant for value 'all'
     * @return string 'all'
     */
    private const ALL = 'all';

    /**
     * Constant for value 'pub'
     * @return string 'pub'
     */
    private const PUB = 'pub';
}
