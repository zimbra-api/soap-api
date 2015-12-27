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
     * @var TypedSequence<WkDay>
     */
    private $days;

    /**
     * Constructor method for ByDayRule
     * @param  array $days By day weekday rule specification
     * @return self
     */
    public function __construct(array $days = [])
    {
        parent::__construct();
        $this->setDays($days);

        $this->on('before', function(Base $sender)
        {
            if($sender->getDays()->count())
            {
                $sender->setChild('wkday', $sender->getDays()->all());
            }
        });
    }

    /**
     * Add week day
     *
     * @param  WkDay $day
     * @return self
     */
    public function addDay(WkDay $day)
    {
        $this->days->add($day);
        return $this;
    }

    /**
     * Sets wkday sequence
     *
     * @param  array $days
     * @return self
     */
    public function setDays(array $days)
    {
        $this->days = new TypedSequence('Zimbra\Mail\Struct\WkDay', $days);
        return $this;
    }

    /**
     * Gets wkday sequence
     *
     * @return Sequence
     */
    public function getDays()
    {
        return $this->days;
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
