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

use Zimbra\Soap\Request;
use Zimbra\Mail\Struct\NewMountpointSpec;

/**
 * CreateMountpoint request class
 * Create mountpoint
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateMountpoint extends Request
{
    /**
     * Constructor method for CreateMountpoint
     * @param  NewMountpointSpec $link
     * @return self
     */
    public function __construct(NewMountpointSpec $link)
    {
        parent::__construct();
        $this->child('link', $link);
    }

    /**
     * Get or set link
     * New mountpoint specification
     *
     * @param  NewMountpointSpec $link
     * @return NewMountpointSpec|self
     */
    public function link(NewMountpointSpec $link = null)
    {
        if(null === $link)
        {
            return $this->child('link');
        }
        return $this->child('link', $link);
    }
}
