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
 * BrowseBy enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class BrowseBy extends Base
{
    /**
     * Constant for value 'domains'
     * @return string 'adminName'
     */
    const DOMAINS = 'domains';

    /**
     * Constant for value 'attachments'
     * @return string 'attachments'
     */
    const ATTACHMENTS = 'attachments';

    /**
     * Constant for value 'objects'
     * @return string 'objects'
     */
    const OBJECTS = 'objects';
}
