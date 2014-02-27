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
 * CallForwardNoAnswerFeature struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CallForwardNoAnswerFeature extends CallFeatureInfo
{
    /**
     * Constructor method for CallForwardNoAnswerFeature
     * @param bool   $s
     * @param bool   $a
     * @param string $ft
     * @param string $nr
     * @return self
     */
    public function __construct($s, $a, $ft = null, $nr = null)
    {
    	parent::__construct($s, $a);
        if(null !== $ft)
        {
            $this->property('ft', trim($ft));
        }
        if(null !== $nr)
        {
            $this->property('nr', trim($nr));
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
     * Gets or sets nr
     *
     * @param  string $nr
     * @return string|self
     */
    public function nr($nr = null)
    {
        if(null === $nr)
        {
            return $this->property('nr');
        }
        return $this->property('nr', trim($nr));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'callforwardnoanswer')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'callforwardnoanswer')
    {
        return parent::toXml($name);
    }
}
