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
 * IdsAttr struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class IdsAttr extends Base
{
    /**
     * Constructor method for IdsAttr
     * @param  string $ids IDs
     * @return self
     */
    public function __construct($ids)
    {
        parent::__construct();
        $this->setProperty('ids', trim($ids));
    }

    /**
     * Gets ids
     *
     * @return string
     */
    public function getIds()
    {
        return $this->getProperty('ids');
    }

    /**
     * Sets ids
     *
     * @param  string $ids
     * @return self
     */
    public function setIds($ids)
    {
        return $this->setProperty('ids', trim($ids));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'm')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'm')
    {
        return parent::toXml($name);
    }
}
