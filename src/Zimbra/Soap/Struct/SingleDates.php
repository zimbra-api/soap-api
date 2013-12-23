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
use Zimbra\Utils\TypedSequence;

/**
 * SingleDates struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SingleDates
{
    /**
     * Information on start date/time and end date/time or duration
     * @var TypedSequence
     */
    private $_dtval;

    /**
     * TZID
     * @var string
     */
    private $_tz;

    /**
     * Constructor method for SingleDates
     * @param string $tz
     * @param array $dtval
     * @return self
     */
    public function __construct(
        $tz = null,
        array $dtval = array()
    )
    {
        $this->_tz = trim($tz);
        $this->_dtval = new TypedSequence('Zimbra\Soap\Struct\DtVal', $dtval);
    }

    /**
     * Gets or sets tz
     *
     * @param  string $tz
     * @return string|self
     */
    public function tz($tz = null)
    {
        if(null === $tz)
        {
            return $this->_tz;
        }
        $this->_tz = trim($tz);
        return $this;
    }

    /**
     * Add dtval
     *
     * @param  DtVal $dtval
     * @return self
     */
    public function addDtVal(DtVal $dtval)
    {
        $this->_dtval->add($dtval);
        return $this;
    }

    /**
     * Gets dtval sequence
     *
     * @return Sequence
     */
    public function dtval()
    {
        return $this->_dtval;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'dates')
    {
        $name = !empty($name) ? $name : 'dates';
        $arr = array();
        if(!empty($this->_tz))
        {
            $arr['tz'] = $this->_tz;
        }
        if(count($this->_dtval))
        {
            $arr['dtval'] = array();
            foreach ($this->_dtval as $dtval)
            {
                $dtvalArr = $dtval->toArray('dtval');
                $arr['dtval'][] = $dtvalArr['dtval'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'dates')
    {
        $name = !empty($name) ? $name : 'dates';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_tz))
        {
            $xml->addAttribute('tz', $this->_tz);
        }
        foreach ($this->_dtval as $dtval)
        {
            $xml->append($dtval->toXml('dtval'));
        }
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
