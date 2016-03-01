<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copypart and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Struct\Base;

/**
 * MsgPartIds struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class MsgPartIds extends Base
{
    /**
     * Constructor method for MsgPartIds
     * @param string $id Message ID
     * @param string $part Comma separated list of part IDs to remove
     * @return self
     */
    public function __construct($id, $part)
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->setProperty('part', trim($part));
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets part
     *
     * @return string
     */
    public function getPart()
    {
        return $this->getProperty('part');
    }

    /**
     * Sets part
     *
     * @param  string $part
     * @return self
     */
    public function setPart($part)
    {
        return $this->setProperty('part', trim($part));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'm')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'm')
    {
        return parent::toXml($name);
    }
}
