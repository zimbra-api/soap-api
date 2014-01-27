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
 * NewContactGroupMember struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class NewContactGroupMember extends Base
{
    /**
     * Constructor method for NewContactGroupMember
     * @param string $type
     * @param string $value
     * @return self
     */
    public function __construct($type, $value)
    {
        parent::__construct();
        $this->property('type', trim($type));
        $this->property('value', trim($value));
    }

    /**
     * Gets or sets type
     * Member type
     * C: reference to another contact
     * G: reference to a GAL entry
     * I: inlined member (member name and email address is embeded in the contact group)
     *
     * @param  string $type
     * @return string|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return $this->property('type');
        }
        return $this->property('type', trim($type));
    }

    /**
     * Gets or sets value
     * Member value
     * type="C": Item ID of another contact. If the referenced contact is in a shared folder, the item ID must be qualified by zimbraId of the owner. e.g. {zimbraId}:{itemId}
     * type="G": GAL entry reference (returned in SearchGalResponse)
     * type="I": name and email address in the form of: "{name}" <{email}>
     *
     * @param  string $value
     * @return string|self
     */
    public function value($value = null)
    {
        if(null === $value)
        {
            return $this->property('value');
        }
        return $this->property('value', trim($value));
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
