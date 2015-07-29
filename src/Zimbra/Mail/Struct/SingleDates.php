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
 * SingleDates struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SingleDates extends Base implements RecurRuleBase
{
    /**
     * Information on start date/time and end date/time or duration
     * @var TypedSequence<DtVal>
     */
    private $_dtVals;

    /**
     * Constructor method for SingleDates
     * @param string $tz
     * @param array $dtval
     * @return self
     */
    public function __construct(
        $tz = null,
        array $dtVals = []
    )
    {
        parent::__construct();
        if(null !== $tz)
        {
            $this->setProperty('tz', trim($tz));
        }
        $this->setDtVals($dtVals);
        $this->on('before', function(Base $sender)
        {
            if($sender->getDtVals()->count())
            {
                $sender->setChild('dtval', $sender->getDtVals()->all());
            }
        });
    }

    /**
     * Gets timezone
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->getProperty('tz');
    }

    /**
     * Sets timezone
     *
     * @param  string $tz
     * @return self
     */
    public function setTimezone($tz)
    {
        return $this->setProperty('tz', trim($tz));
    }

    /**
     * Add dtval
     *
     * @param  DtVal $dtval
     * @return self
     */
    public function addDtVal(DtVal $dtval)
    {
        $this->_dtVals->add($dtval);
        return $this;
    }

    /**
     * Sets dtval sequence
     *
     * @param  array $dtVals
     * @return self
     */
    public function setDtVals(array $dtVals)
    {
        $this->_dtVals = new TypedSequence('Zimbra\Mail\Struct\DtVal', $dtVals);
        return $this;
    }

    /**
     * Gets dtval sequence
     *
     * @return Sequence
     */
    public function getDtVals()
    {
        return $this->_dtVals;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'dates')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'dates')
    {
        return parent::toXml($name);
    }
}
