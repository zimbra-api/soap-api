<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Struct;

/**
 * SelectiveCallForwardFeature struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SelectiveCallForwardFeature extends FeatureWithCallerList
{
    /**
     * Constructor method for SelectiveCallForwardFeature
     * @param bool   $s
     * @param bool   $a
     * @param array  $phone
     * @param string $ft
     * @return self
     */
    public function __construct($s, $a, array $phone = array(), $ft = null)
    {
    	parent::__construct($s, $a, $phone);
        if(null !== $ft)
        {
            $this->property('ft', trim($ft));
        }
    }

    /**
     * Gets or sets ft
     *
     * @param  string $ft
     * @return string|self
     */
    public function ft($ft = null)
    {
        if(null === $ft)
        {
            return $this->property('ft');
        }
        return $this->property('ft', trim($ft));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'selectivecallforward')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'selectivecallforward')
    {
        return parent::toXml($name);
    }
}
