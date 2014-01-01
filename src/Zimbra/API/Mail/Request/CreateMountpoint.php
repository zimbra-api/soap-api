<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\NewMountpointSpec;

/**
 * CreateMountpoint request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateMountpoint extends Request
{
    /**
     * New mountpoint specification
     * @var NewMountpointSpec
     */
    private $_link;

    /**
     * Constructor method for CreateMountpoint
     * @param  NewMountpointSpec $link
     * @return self
     */
    public function __construct(NewMountpointSpec $link)
    {
        parent::__construct();
        $this->_link = $link;
    }

    /**
     * Get or set link
     *
     * @param  NewMountpointSpec $link
     * @return NewMountpointSpec|self
     */
    public function link(NewMountpointSpec $link = null)
    {
        if(null === $link)
        {
            return $this->_link;
        }
        $this->_link = $link;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array += $this->_link->toArray('link');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_link->toXml('link'));
        return parent::toXml();
    }
}
