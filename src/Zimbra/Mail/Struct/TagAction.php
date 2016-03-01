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
 * TagAction class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class TagAction extends FilterAction
{
    /**
     * Constructor method for TagAction
     * @param int $index
     * @param string $tagName
     * @return self
     */
    public function __construct($index, $tagName = null)
    {
        parent::__construct($index);
        if(null !== $tagName)
        {
            $this->setProperty('tagName', trim($tagName));
        }
    }

    /**
     * Gets tag name
     *
     * @return string
     */
    public function getTag()
    {
        return $this->getProperty('tagName');
    }

    /**
     * Sets tag name
     *
     * @param  string $tagName
     * @return self
     */
    public function setTag($tagName)
    {
        return $this->setProperty('tagName', trim($tagName));
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'actionTag')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'actionTag')
    {
        return parent::toXml($name);
    }
}
