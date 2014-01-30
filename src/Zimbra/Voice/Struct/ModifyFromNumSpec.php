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
     * @param string $oldPhone
     * @param string $phone
     * @param string $id
     * @param string $label
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
        $this->property('oldPhone', trim($oldPhone));
        $this->property('phone', trim($phone));
        $this->property('id', trim($id));
        $this->property('label', trim($label));
    }

    /**
     * Gets or sets oldPhone
     *
     * @param  string $oldPhone
     * @return string|self
     */
    public function oldPhone($oldPhone = null)
    {
        if(null === $oldPhone)
        {
            return $this->property('oldPhone');
        }
        return $this->property('oldPhone', trim($oldPhone));
    }

    /**
     * Gets or sets phone
     *
     * @param  string $phone
     * @return string|self
     */
    public function phone($phone = null)
    {
        if(null === $phone)
        {
            return $this->property('phone');
        }
        return $this->property('phone', trim($phone));
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
     * Gets or sets label
     *
     * @param  string $label
     * @return string|self
     */
    public function label($label = null)
    {
        if(null === $label)
        {
            return $this->property('label');
        }
        return $this->property('label', trim($label));
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
