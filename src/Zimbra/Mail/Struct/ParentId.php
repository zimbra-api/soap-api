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
 * ParentId struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ParentId extends Base
{
    /**
     * Constructor method for ParentId
     * @param  string $parentId Item ID of parent
     * @return self
     */
    public function __construct($parentId)
    {
        parent::__construct();
        $this->setProperty('parentId', trim($parentId));
    }

    /**
     * Gets parentId
     *
     * @return string
     */
    public function getParentId()
    {
        return $this->getProperty('parentId');
    }

    /**
     * Sets parentId
     *
     * @param  string $parentId
     * @return self
     */
    public function setParentId($parentId)
    {
        return $this->setProperty('parentId', trim($parentId));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'parent')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'parent')
    {
        return parent::toXml($name);
    }
}
