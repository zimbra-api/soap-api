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
class CreateMountpoint extends Base
{
    /**
     * Constructor method for CreateMountpoint
     * @param  NewMountpointSpec $link
     * @return self
     */
    public function __construct(NewMountpointSpec $link)
    {
        parent::__construct();
        $this->setChild('link', $link);
    }

    /**
     * Gets mountpoint specification
     *
     * @return NewMountpointSpec
     */
    public function getFolder()
    {
        return $this->getChild('link');
    }

    /**
     * Sets mountpoint specification
     *
     * @param  NewMountpointSpec $link
     * @return self
     */
    public function setFolder(NewMountpointSpec $link)
    {
        return $this->setChild('link', $link);
    }
}
