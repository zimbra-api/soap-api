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
 * Right struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class Right extends Base
{
    /**
     * Constructor method for right
     * @param string $right
     * @return self
     */
    public function __construct($right)
    {
        parent::__construct();
        $this->setProperty('right', trim($right));
    }

    /**
     * Gets name for right
     *
     * @return string
     */
    public function getRight()
    {
        return $this->getProperty('right');
    }

    /**
     * Sets name for right
     *
     * @param  string $right
     * @return self
     */
    public function setRight($right)
    {
        return $this->setProperty('right', trim($right));
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'ace')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'ace')
    {
        return parent::toXml($name);
    }
}
