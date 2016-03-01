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
 * NumAttr struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class NumAttr extends Base
{
    /**
     * Constructor method for NumAttr
     * @param  int $num Number
     * @return self
     */
    public function __construct($num)
    {
        parent::__construct();
        $this->setProperty('num', (int) $num);
    }

    /**
     * Gets number
     *
     * @return bool
     */
    public function getNum()
    {
        return $this->getProperty('num');
    }

    /**
     * Sets number
     *
     * @param  bool $num
     * @return self
     */
    public function setNum($num)
    {
        return $this->setProperty('num', (int) $num);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'count')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'count')
    {
        return parent::toXml($name);
    }
}
