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
 * TzFixupRuleMatchDate struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class TzFixupRuleMatchDate extends Base
{
    /**
     * Constructor method for TzFixupRuleMatchDate
     * @param int $mon Match month. Value between 1 (January) and 12 (December)
     * @param int $mday Match day of month (1..31
     * @return self
     */
    public function __construct($mon, $mday)
    {
        parent::__construct();
        $mon = in_array((int) $mon, range(1, 12)) ? (int) $mon : 1;
        $this->property('mon', $mon);

        $mday = in_array((int) $mday, range(1, 31)) ? (int) $mday : 1;
        $this->property('mday', $mday);
    }

    /**
     * Gets or sets mon
     *
     * @param  int $mon
     * @return int|self
     */
    public function mon($mon = null)
    {
        if(null === $mon)
        {
            return $this->property('mon');
        }
        $mon = in_array((int) $mon, range(1, 12)) ? (int) $mon : 1;
        return $this->property('mon', $mon);
    }

    /**
     * Gets or sets mday
     *
     * @param  int $mday
     * @return int|self
     */
    public function mday($mday = null)
    {
        if(null === $mday)
        {
            return $this->property('mday');
        }
        $mday = in_array((int) $mday, range(1, 31)) ? (int) $mday : 1;
        return $this->property('mday', $mday);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'date')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'date')
    {
        return parent::toXml($name);
    }
}