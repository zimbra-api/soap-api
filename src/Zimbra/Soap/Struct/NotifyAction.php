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

/**
 * NotifyAction class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class NotifyAction extends FilterAction
{
    /**
     * Tag name
     * @var string
     */
    private $_content;

    /**
     * @var string
     */
    private $_a;

    /**
     * @var string
     */
    private $_su;

    /**
     * @var int
     */
    private $_maxBodySize;

    /**
     * @var string
     */
    private $_origHeaders;

    /**
     * Constructor method for NotifyAction
     * @param int $index
     * @param string $content
     * @return self
     */
    public function __construct(
        $index,
        $content = null,
        $a = null,
        $su = null,
        $maxBodySize = null,
        $origHeaders = null
    )
    {
        parent::__construct($index);
        $this->_content = trim($content);
        $this->_a = trim($a);
        $this->_su = trim($su);
        if(null !== $maxBodySize)
        {
            $this->_maxBodySize = (int) $maxBodySize;
        }
        $this->_origHeaders = trim($origHeaders);
    }

    /**
     * Gets or sets content
     *
     * @param  string $content
     * @return string|self
     */
    public function content($content = null)
    {
        if(null === $content)
        {
            return $this->_content;
        }
        $this->_content = trim($content);
        return $this;
    }

    /**
     * Gets or sets a
     *
     * @param  string $a
     * @return string|self
     */
    public function a($a = null)
    {
        if(null === $a)
        {
            return $this->_a;
        }
        $this->_a = trim($a);
        return $this;
    }

    /**
     * Gets or sets su
     *
     * @param  string $su
     * @return string|self
     */
    public function su($su = null)
    {
        if(null === $su)
        {
            return $this->_su;
        }
        $this->_su = trim($su);
        return $this;
    }

    /**
     * Gets or sets maxBodySize
     *
     * @param  int $maxBodySize
     * @return int|self
     */
    public function maxBodySize($maxBodySize = null)
    {
        if(null === $maxBodySize)
        {
            return $this->_maxBodySize;
        }
        $this->_maxBodySize = (int) $maxBodySize;
        return $this;
    }

    /**
     * Gets or sets origHeaders
     *
     * @param  string $origHeaders
     * @return string|self
     */
    public function origHeaders($origHeaders = null)
    {
        if(null === $origHeaders)
        {
            return $this->_origHeaders;
        }
        $this->_origHeaders = trim($origHeaders);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'actionNotify')
    {
        $name = !empty($name) ? $name : 'actionNotify';
        $arr = parent::toArray($name);
        if(!empty($this->_content))
        {
            $arr[$name]['content'] = $this->_content;
        }
        if(!empty($this->_a))
        {
            $arr[$name]['a'] = $this->_a;
        }
        if(!empty($this->_su))
        {
            $arr[$name]['su'] = $this->_su;
        }
        if(is_int($this->_maxBodySize))
        {
            $arr[$name]['maxBodySize'] = $this->_maxBodySize;
        }
        if(!empty($this->_origHeaders))
        {
            $arr[$name]['origHeaders'] = $this->_origHeaders;
        }
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'actionNotify')
    {
        $name = !empty($name) ? $name : 'actionNotify';
        $xml = parent::toXml($name);
        if(!empty($this->_a))
        {
            $xml->addAttribute('a', $this->_a);
        }
        if(!empty($this->_su))
        {
            $xml->addAttribute('su', $this->_su);
        }
        if(is_int($this->_maxBodySize))
        {
            $xml->addAttribute('maxBodySize', $this->_maxBodySize);
        }
        if(!empty($this->_origHeaders))
        {
            $xml->addAttribute('origHeaders', $this->_origHeaders);
        }
        if(!empty($this->_content))
        {
            $xml->addChild('content', $this->_content);
        }
        return $xml;
    }
}
