<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

/**
 * GetAvailableSkins request class
 * Get the intersection of installed skins on the server and the list specified in the zimbraAvailableSkin on an account (or its CoS).
 * If none is set in zimbraAvailableSkin, get the entire list of installed skins.
 * The installed skin list is obtained by a directory scan of the designated location of skins on a server.
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAvailableSkins extends Base
{
}
