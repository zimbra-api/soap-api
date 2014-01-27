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
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
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
            $this->child('content', trim($content));
        }
        if(null !== $a)
        {
            $this->property('a', trim($a));
        }
        if(null !== $su)
        {
            $this->property('su', trim($su));
        }
        if(null !== $maxBodySize)
        {
            $this->property('maxBodySize', (int) $maxBodySize);
        }
        if(null !== $origHeaders)
        {
            $this->property('origHeaders', trim($origHeaders));
        }
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
            return $this->child('content');
        }
        return $this->child('content', trim($content));
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
            return $this->property('a');
        }
        return $this->property('a', trim($a));
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
            return $this->property('su');
        }
        return $this->property('su', trim($su));
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
            return $this->property('maxBodySize');
        }
        return $this->property('maxBodySize', (int) $maxBodySize);
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
            return $this->property('origHeaders');
        }
        return $this->property('origHeaders', trim($origHeaders));
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
