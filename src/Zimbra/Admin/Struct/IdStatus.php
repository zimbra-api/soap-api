<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Struct\Base;

/**
 * IdStatus struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class IdStatus extends Base
{
    /**
     * Constructor method for IdStatus
     * @param  string $id
     * @param  string $status
     * @return self
     */
    public function __construct($id = null, $status = null)
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->setProperty('status', trim($status));
    }

    /**
     * Gets Zimbra ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets Zimbra ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->getProperty('status');
    }

    /**
     * Sets status
     *
     * @param  string $status
     * @return self
     */
    public function setStatus($status)
    {
        return $this->setProperty('status', trim($status));
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
