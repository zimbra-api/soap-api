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
 * ConstraintAttr class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ConstraintAttr
{
    /**
     * Constraint name
     * @var string
     */
    private $_name;

    /**
     * Constraint information
     * @var string
     */
    private $_constraint;

    /**
     * Constructor method for ConstraintAttr
     * @param  string $name
     * @param  ConstraintInfo $constraint
     * @return self
     */
    public function __construct($name, ConstraintInfo $constraint)
    {
        $this->_name = trim($name);
        $this->_constraint = $constraint;
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Gets or sets constraint
     *
     * @param  ConstraintInfo $constraint
     * @return ConstraintInfo|self
     */
    public function constraint(ConstraintInfo $constraint = null)
    {
        if(null === $constraint)
        {
            return $this->_constraint;
        }
        $this->_constraint = $constraint;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'a')
    {
        $name = !empty($name) ? $name : 'a';
        $arr = array(
            'name' => $this->_name,
        );
        $arr += $this->_constraint->toArray();
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'a')
    {
        $name = !empty($name) ? $name : 'a';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('name', $this->_name)
            ->append($this->_constraint->toXml());
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}