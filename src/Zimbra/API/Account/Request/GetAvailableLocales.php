<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Account\Request;

use Zimbra\Soap\Request;

/**
 * GetAvailableLocales class
 * Get the intersection of all translated locales installed on the server and the list specified in zimbraAvailableLocale.
 * The locale list in the response is sorted by display name (name attribute).
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAvailableLocales extends Request
{
    /**
     * Constructor method for GetAvailableLocales
     * @return self
     */
    public function __construct()
    {
        parent::__construct();
    }
}
