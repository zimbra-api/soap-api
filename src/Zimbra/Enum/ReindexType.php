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
 * ReindexType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ReindexType extends Base
{
    /**
     * Constant for value 'conversation'
     * @return string 'conversation'
     */
    const CONVERSATION = 'conversation';

    /**
     * Constant for value 'message'
     * @return string 'message'
     */
    const MESSAGE = 'message';

    /**
     * Constant for value 'contact'
     * @return string 'contact'
     */
    const CONTACT = 'contact';

    /**
     * Constant for value 'appointment'
     * @return string 'appointment'
     */
    const APPOINTMENT = 'appointment';

    /**
     * Constant for value 'task'
     * @return string 'task'
     */
    const TASK = 'task';

    /**
     * Constant for value 'note'
     * @return string 'note'
     */
    const NOTE = 'note';

    /**
     * Constant for value 'wiki'
     * @return string 'wiki'
     */
    const WIKI = 'wiki';

    /**
     * Constant for value 'document'
     * @return string 'document'
     */
    const DOCUMENT = 'document';
}
