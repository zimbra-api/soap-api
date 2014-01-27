<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Struct\Base;

/**
 * IdStatus struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class IdStatus extends Base
{
    /**
     * Constructor method for IdStatus
     * @param  string $id The id
     * @param  string $status The status
     * @return self
     */
    public function __construct($id = null, $status = null)
    {
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $status)
        {
            $this->property('status', trim($status));
        }
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets status
     *
     * @param  string $status
     * @return string|self
     */
    public function status($status = null)
    {
        if(null === $status)
        {
            return $this->property('status');
        }
        return $this->property('status', trim($status));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'device')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'device')
    {
        return parent::toXml($name);
    }
}
