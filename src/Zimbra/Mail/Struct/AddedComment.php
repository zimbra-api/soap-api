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

use Zimbra\Struct\Base;

/**
 * AddedComment struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddedComment extends Base
{
    /**
     * Constructor method for AddedComment
     *
     * @param string $parentId Item ID of parent
     * @param string $text Comment text
     * @return self
     */
    public function __construct($parentId, $text)
    {
        parent::__construct();
        $this->setProperty('parentId', trim($parentId));
        $this->setProperty('text', trim($text));
    }

    /**
     * Gets parent id
     *
     * @return string
     */
    public function getParentId()
    {
        return $this->getProperty('parentId');
    }

    /**
     * Sets parent id
     *
     * @param  string $parentId
     * @return self
     */
    public function setParentId($parentId)
    {
        return $this->setProperty('parentId', trim($parentId));
    }

    /**
     * Gets text
     *
     * @return string
     */
    public function getText()
    {
        return $this->getProperty('text');
    }

    /**
     * Sets text
     *
     * @param  string $text
     * @return self
     */
    public function setText($text)
    {
        return $this->setProperty('text', trim($text));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'comment')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'comment')
    {
        return parent::toXml($name);
    }
}
