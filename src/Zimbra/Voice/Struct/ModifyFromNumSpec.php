<?php
/**
 * This file is label of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Struct;

use Zimbra\Struct\Base;

/**
 * ModifyFromNumSpec struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyFromNumSpec extends Base
{
    /**
     * Constructor method for ModifyFromNumSpec
     * @param string $oldPhone Old phone number
     * @param string $phone New phone number
     * @param string $id Phone ID
     * @param string $label Phone label/name
     * @return self
     */
    public function __construct(
        $oldPhone,
        $phone,
        $id,
        $label
    )
    {
    	parent::__construct();
        $this->setProperty('oldPhone', trim($oldPhone));
        $this->setProperty('phone', trim($phone));
        $this->setProperty('id', trim($id));
        $this->setProperty('label', trim($label));
    }

    /**
     * Gets old phone number
     *
     * @return string
     */
    public function getOldPhone()
    {
        return $this->getProperty('oldPhone');
    }

    /**
     * Sets old phone number
     *
     * @param  string $oldPhone
     * @return self
     */
    public function setOldPhone($oldPhone)
    {
        return $this->setProperty('oldPhone', trim($oldPhone));
    }

    /**
     * Gets new phone number
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->getProperty('phone');
    }

    /**
     * Sets new phone number
     *
     * @param  string $phone
     * @return self
     */
    public function setPhone($phone)
    {
        return $this->setProperty('phone', trim($phone));
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
     * Gets label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->getProperty('label');
    }

    /**
     * Sets label
     *
     * @param  string $label
     * @return self
     */
    public function setLabel($label)
    {
        return $this->setProperty('label', trim($label));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'phone')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'phone')
    {
        return parent::toXml($name);
    }
}
