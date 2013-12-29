<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * NewContactGroupMember struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class NewContactGroupMember
{
    /**
     * Member type
     * C: reference to another contact
     * G: reference to a GAL entry
     * I: inlined member (member name and email address is embeded in the contact group)
     * @var string
     */
    private $_type;

    /**
     * Member value
     * type="C": Item ID of another contact. If the referenced contact is in a shared folder, the item ID must be qualified by zimbraId of the owner. e.g. {zimbraId}:{itemId}
     * type="G": GAL entry reference (returned in SearchGalResponse)
     * type="I": name and email address in the form of: "{name}" <{email}>
     * @var string
     */
    private $_value;

    /**
     * Constructor method for NewContactGroupMember
     * @param string $type
     * @param string $value
     * @return self
     */
    public function __construct(
        $type,
        $value
    )
    {
        $this->_type = trim($type);
        $this->_value = trim($value);
    }

    /**
     * Gets or sets type
     *
     * @param  string $type
     * @return string|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        $this->_type = trim($type);
        return $this;
    }

    /**
     * Gets or sets value
     *
     * @param  string $value
     * @return string|self
     */
    public function value($value = null)
    {
        if(null === $value)
        {
            return $this->_value;
        }
        $this->_value = trim($value);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'm')
    {
        $name = !empty($name) ? $name : 'm';
        $arr = array(
            'type' => $this->_type,
            'value' => $this->_value,
        );
        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'm')
    {
        $name = !empty($name) ? $name : 'm';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('type', $this->_type)
        	->addAttribute('value', $this->_value);
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
