<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Struct\Id;

/**
 * GetShareDetails request class
 * Get item acl details
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetShareDetails extends Base
{
    /**
     * Constructor method for GetShareDetails
     * @param  Id $item
     * @return self
     */
    public function __construct(Id $item)
    {
        parent::__construct();
        $this->child('item', $item);
    }

    /**
     * Get or set item
     *
     * @param  Id $item
     * @return Id|self
     */
    public function item(Id $item = null)
    {
        if(null === $item)
        {
            return $this->child('item');
        }
        return $this->child('item', $item);
    }
}
