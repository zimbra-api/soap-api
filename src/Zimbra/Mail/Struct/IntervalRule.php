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
 * IntervalRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class IntervalRule extends Base
{
    /**
     * Constructor method for IntervalRule
     * @param  int $ival Rule interval count - a positive integer
     * @return self
     */
    public function __construct($ival)
    {
        parent::__construct();
        $this->setProperty('ival', abs((int) $ival));
    }

    /**
     * Gets ival
     *
     * @return int
     */
    public function getIval()
    {
        return $this->getProperty('ival');
    }

    /**
     * Sets ival
     *
     * @param  int $ival
     * @return self
     */
    public function setIval($ival)
    {
        return $this->setProperty('ival', (int) $ival);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'interval')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'interval')
    {
        return parent::toXml($name);
    }
}
