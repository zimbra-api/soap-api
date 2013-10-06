<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;

/**
 * ResetAllLoggers class
 * Removes all account loggers and reloads /opt/zimbra/conf/log4j.properties.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ResetAllLoggers extends Request
{
    /**
     * Constructor method for ResetAllLoggers
     * @return self
     */
    public function __construct()
    {
        parent::__construct();
    }
}
