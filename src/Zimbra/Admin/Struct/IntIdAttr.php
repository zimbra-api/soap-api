<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Struct\Base;

/**
 * IntIdAttr struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class IntIdAttr extends Base
{
    /**
     * Constructor method for IntIdAttr
     * @param  int $id
     * @return self
     */
    public function __construct($id)
    {
        parent::__construct();
        $this->setProperty('id', (int) $id);
    }

    /**
     * Gets ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets ID
     *
     * @param  int $id
     * @return self
     */
    public function setId($id)
    {
        $this->setProperty('id', (int) $id);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'attr')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'attr')
    {
        return parent::toXml($name);
    }
}
