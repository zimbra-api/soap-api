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
 * RecurIdInfo struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RecurIdInfo
{
    /**
     * Recurrence range type
     * @var int
     */
    protected $_rangeType;

    /**
     * Recurrence ID in format : YYMMDD[THHMMSS[Z]]
     * @var string
     */
    protected $_recurId;

    /**
     * Timezone name
     * @var string
     */
    protected $_tz;

    /**
     * Recurrence-id in UTC time zone; used in non-all-day appointments only 
     * Format: YYMMDDTHHMMSSZ
     * @var string
     */
    protected $_ridZ;

    /**
     * Constructor method for RecurIdInfo
     * @param int $rangeType
     * @param string $recurId
     * @param string $tz
     * @param string $ridZ
     * @return self
     */
    public function __construct(
        $rangeType,
        $recurId,
        $tz = null,
        $ridZ = null
    )
    {
        $this->_rangeType = (int) $rangeType;
        $this->_recurId = trim($recurId);
        $this->_tz = trim($tz);
        $this->_ridZ = trim($ridZ);
    }

    /**
     * Gets or sets rangeType
     *
     * @param  int $rangeType
     * @return int|self
     */
    public function rangeType($rangeType = null)
    {
        if(null === $rangeType)
        {
            return $this->_rangeType;
        }
        $this->_rangeType = (int) $rangeType;
        return $this;
    }

    /**
     * Gets or sets recurId
     *
     * @param  string $recurId
     * @return string|self
     */
    public function recurId($recurId = null)
    {
        if(null === $recurId)
        {
            return $this->_recurId;
        }
        $this->_recurId = trim($recurId);
        return $this;
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
     * Gets or sets ridZ
     *
     * @param  string $ridZ
     * @return string|self
     */
    public function ridZ($ridZ = null)
    {
        if(null === $ridZ)
        {
            return $this->_ridZ;
        }
        $this->_ridZ = trim($ridZ);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'recur')
    {
        $name = !empty($name) ? $name : 'recur';
        $arr = array(
            'rangeType' => $this->_rangeType,
            'recurId' => $this->_recurId,
        );
        if(!empty($this->_tz))
        {
            $arr['tz'] = $this->_tz;
        }
        if(!empty($this->_ridZ))
        {
            $arr['ridZ'] = $this->_ridZ;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'recur')
    {
        $name = !empty($name) ? $name : 'recur';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('rangeType', $this->_rangeType)
            ->addAttribute('recurId', $this->_recurId);
        if(!empty($this->_tz))
        {
            $xml->addAttribute('tz', $this->_tz);
        }
        if(!empty($this->_ridZ))
        {
            $xml->addAttribute('ridZ', $this->_ridZ);
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
