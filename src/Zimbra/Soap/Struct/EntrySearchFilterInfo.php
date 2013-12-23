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

use Zimbra\Soap\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Soap\Struct\EntrySearchFilterSingleCond as SingleCond;
use Zimbra\Utils\SimpleXML;

/**
 * EntrySearchFilterInfo class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class EntrySearchFilterInfo
{
    /**
     * The conds
     * @var MultiCond
     */
    private $_conds;

    /**
     * The cond
     * @var SingleCond
     */
    private $_cond;
    /**
     * Constructor method for entrySearchFilterInfo
     * @param MultiCond $conds
     * @param SingleCond $cond
     * @return self
     */
    public function __construct(MultiCond $conds = null, SingleCond $cond = null)
    {
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
     * Gets or sets conds
     *
     * @param  MultiCond $conds
     * @return MultiCond|self
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
    public function toArray($name = 'searchFilter')
    {
        $name = !empty($name) ? $name : 'searchFilter';
        $arr = array();
        if($this->_conds instanceof MultiCond)
        {
            $arr += $this->_conds->toArray();
        }
        if($this->_cond instanceof SingleCond)
        {
            $arr += $this->_cond->toArray();
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'searchFilter')
    {
        $name = !empty($name) ? $name : 'searchFilter';
        $xml = new SimpleXML('<'.$name.' />');
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
