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
 * GetAvailableSkins class
 * Get the intersection of installed skins on the server and the list specified in the zimbraAvailableSkin on an account (or its CoS).
 * If none is set in zimbraAvailableSkin, get the entire list of installed skins.
 * The installed skin list is obtained by a directory scan of the designated location of skins on a server.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAvailableSkins extends Request
{
    /**
     * Constructor method for GetAvailableSkins
     * @return self
     */
    public function __construct()
    {
        parent::__construct();
    }
}
