<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

/**
 * NotifyAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class NotifyAction extends FilterAction
{
    /**
     * Constructor method for NotifyAction
     * @param int $index Index - specifies a guaranteed order for the action elements
     * @param string $content
     * @param string $a
     * @param string $su
     * @param int    $maxBodySize
     * @param string $origHeaders
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
        if(null !== $content)
        {
            $this->setChild('content', trim($content));
        }
        if(null !== $a)
        {
            $this->setProperty('a', trim($a));
        }
        if(null !== $su)
        {
            $this->setProperty('su', trim($su));
        }
        if(null !== $maxBodySize)
        {
            $this->setProperty('maxBodySize', (int) $maxBodySize);
        }
        if(null !== $origHeaders)
        {
            $this->setProperty('origHeaders', trim($origHeaders));
        }
    }

    /**
     * Gets content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->getChild('content');
    }

    /**
     * Sets content
     *
     * @param  string $content
     * @return self
     */
    public function setContent($content)
    {
        return $this->setChild('content', trim($content));
    }

    /**
     * Gets address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->getProperty('a');
    }

    /**
     * Sets address
     *
     * @param  string $a
     * @return self
     */
    public function setAddress($a)
    {
        return $this->setProperty('a', trim($a));
    }

    /**
     * Gets subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->getProperty('su');
    }

    /**
     * Sets subject
     *
     * @param  string $su
     * @return self
     */
    public function setSubject($su)
    {
        return $this->setProperty('su', trim($su));
    }

    /**
     * Gets maximum body size in bytes
     *
     * @return int
     */
    public function getMaxBodySize()
    {
        return $this->getProperty('maxBodySize');
    }

    /**
     * Sets maximum body size in bytes
     *
     * @param  int $maxBodySize
     * @return self
     */
    public function setMaxBodySize($maxBodySize)
    {
        return $this->setProperty('maxBodySize', (int) $maxBodySize);
    }

    /**
     * Gets comma-separated list of header names
     *
     * @return string
     */
    public function getOrigHeaders()
    {
        return $this->getProperty('origHeaders');
    }

    /**
     * Sets comma-separated list of header names
     *
     * @param  string $origHeaders
     * @return self
     */
    public function setOrigHeaders($origHeaders)
    {
        return $this->setProperty('origHeaders', trim($origHeaders));
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'actionNotify')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'actionNotify')
    {
        return parent::toXml($name);
    }
}
