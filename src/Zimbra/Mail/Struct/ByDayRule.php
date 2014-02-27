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

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * ByDayRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ByDayRule extends Base
{
    /**
     * By day weekday rule specification
     * @var TypedSequence
     */
    private $_wkday;

    /**
     * Constructor method for ByDayRule
     * @param  array $wkdays By day weekday rule specification
     * @return self
     */
    public function __construct(array $wkdays = array())
    {
        parent::__construct();
        $this->_wkday = new TypedSequence('Zimbra\Mail\Struct\WkDay', $wkdays);

        $this->on('before', function(Base $sender)
        {
            if($sender->wkday()->count())
            {
                $sender->child('wkday', $sender->wkday()->all());
            }
        });
    }

    /**
     * Add xparam
     *
     * @param  WkDay $xparam
     * @return self
     */
    public function addWkDay(WkDay $wkday)
    {
        $this->_wkday->add($wkday);
        return $this;
    }

    /**
     * Gets wkday sequence
     *
     * @return Sequence
     */
    public function wkday()
    {
        return $this->_wkday;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'byday')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'byday')
    {
        return parent::toXml($name);
    }
}
