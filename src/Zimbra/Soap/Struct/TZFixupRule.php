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
 * TZFixupRule class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class TZFixupRule
{
    /**
     * Match
     * @var TZFixupRuleMatch
     */
    private $_match;

    /**
     * Need either "touch" or "replace" but not both 
     * @var SimpleElement
     */
    private $_touch;

    /**
     * Replace any matching timezone with this timezone 
     * Need either "touch" or "replace" but not both
     * @var TZReplaceInfo
     */
    private $_replace;

    /**
     * Constructor method for TZFixupRule
     * @param TZFixupRuleMatch $match
     * @param SimpleElement $touch
     * @param TZReplaceInfo $replace
     * @return self
     */
    public function __construct(
        TZFixupRuleMatch $match = null,
        SimpleElement $touch = null,
        TZReplaceInfo $replace = null)
    {
        if($match instanceof TZFixupRuleMatch)
        {
            $this->_match = $match;
        }
        if($touch instanceof SimpleElement)
        {
            $this->_touch = $touch;
        }
        if($replace instanceof TZReplaceInfo)
        {
            $this->_replace = $replace;
        }
    }

    /**
     * Gets or sets match
     *
     * @param  TZFixupRuleMatch $match
     * @return TZFixupRuleMatch|self
     */
    public function match(TZFixupRuleMatch $match = null)
    {
        if(null === $match)
        {
            return $this->_match;
        }
        $this->_match = $match;
        return $this;
    }

    /**
     * Gets or sets touch
     *
     * @param  SimpleElement $touch
     * @return SimpleElement|self
     */
    public function touch(SimpleElement $touch = null)
    {
        if(null === $touch)
        {
            return $this->_touch;
        }
        $this->_touch = $touch;
        return $this;
    }

    /**
     * Gets or sets replace
     *
     * @param  TZReplaceInfo $replace
     * @return TZReplaceInfo|self
     */
    public function replace(TZReplaceInfo $replace = null)
    {
        if(null === $replace)
        {
            return $this->_replace;
        }
        $this->_replace = $replace;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'fixupRule')
    {
        $name = !empty($name) ? $name : 'fixupRule';
        $arr = array();
        if($this->_match instanceof TZFixupRuleMatch)
        {
            $arr += $this->_match->toArray('match');
        }
        if($this->_touch instanceof SimpleElement)
        {
            $arr += $this->_touch->toArray('touch');
        }
        if($this->_replace instanceof TZReplaceInfo)
        {
            $arr += $this->_replace->toArray('replace');
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'fixupRule')
    {
        $name = !empty($name) ? $name : 'fixupRule';
        $xml = new SimpleXML('<'.$name.' />');
        if($this->_match instanceof TZFixupRuleMatch)
        {
            $xml->append($this->_match->toXml('match'));
        }
        if($this->_touch instanceof SimpleElement)
        {
            $xml->append($this->_touch->toXml('touch'));
        }
        if($this->_replace instanceof TZReplaceInfo)
        {
            $xml->append($this->_replace->toXml('replace'));
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
