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
use Zimbra\Soap\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Soap\Struct\EntrySearchFilterSingleCond as SingleCond;

/**
 * EntrySearchFilterMultiCond class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class EntrySearchFilterMultiCond
{
    /**
     * Negation flag
     * @var boolean
     */
    private $_not;

    /**
     * or flag
     * @var boolean
     */
    private $_or;

    /**
     * The conds
     * @var EntrySearchFilterMultiCond
     */
    private $_conds;

    /**
     * The cond
     * @var SingleCond
     */
    private $_cond;

    /**
     * Constructor method for entrySearchFilterMultiCond
     * @param bool $not
     * @param bool $or
     * @param MultiCond $conds
     * @param SingleCond $cond
     * @return self
     */
    public function __construct(
        $not = null,
        $or = null,
        MultiCond $conds = null,
        SingleCond $cond = null)
    {
        if(null !== $not)
        {
            $this->_not = (bool) $not;
        }
        if(null !== $or)
        {
            $this->_or = (bool) $or;
        }
        if($conds instanceof MultiCond)
        {
            $this->_conds = $conds;
        }
        if($cond instanceof SingleCond)
        {
            $this->_cond = $cond;
        }
    }

    /**
     * Gets or sets not flag
     *
     * @param  bool $not
     * @return bool|self
     */
    public function notFlag($not = null)
    {
        if(null === $not)
        {
            return $this->_not;
        }
        $this->_not = (bool) $not;
        return $this;
    }

    /**
     * Gets or sets or flag
     *
     * @param  bool $or
     * @return bool|self
     */
    public function orFlag($or = null)
    {
        if(null === $or)
        {
            return $this->_or;
        }
        $this->_or = (bool) $or;
        return $this;
    }

    /**
     * Gets or sets conds
     *
     * @param  MultiCond $conds
     * @return EntrySearchFilterMultiCond
     */
    public function conds(MultiCond $conds = null)
    {
        if(null === $conds)
        {
            return $this->_conds;
        }
        $this->_conds = $conds;
        return $this;
    }

    /**
     * Gets or sets cond
     *
     * @param  SingleCond $cond
     * @return SingleCond|self
     */
    public function cond(SingleCond $cond = null)
    {
        if(null === $cond)
        {
            return $this->_cond;
        }
        $this->_cond = $cond;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $arr = array();
        if(is_bool($this->_not))
        {
            $arr['not'] = $this->_not ? 1 : 0;
        }
        if(is_bool($this->_or))
        {
            $arr['or'] = $this->_or ? 1 : 0;
        }
        if($this->_conds instanceof MultiCond)
        {
            $arr += $this->_conds->toArray();
        }
        if($this->_cond instanceof SingleCond)
        {
            $arr += $this->_cond->toArray();
        }

        return array('conds' => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $xml = new SimpleXML('<conds />');
        if(is_bool($this->_not))
        {
            $xml->addAttribute('not', $this->_not ? 1 : 0);
        }
        if(is_bool($this->_or))
        {
            $xml->addAttribute('or', $this->_or ? 1 : 0);
        }
        if($this->_conds instanceof MultiCond)
        {
            $xml->append($this->_conds->toXml());
        }
        if($this->_cond instanceof SingleCond)
        {
            $xml->append($this->_cond->toXml());
        }
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
