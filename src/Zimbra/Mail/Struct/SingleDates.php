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
class SingleDates extends Base
{
    /**
     * Information on start date/time and end date/time or duration
     * @var TypedSequence<DtVal>
     */
    private $_dtval;

    /**
     * Constructor method for SingleDates
     * @param array $dtval
     * @param string $tz
     * @return self
     */
    public function __construct(
        array $dtval = array(),
        $tz = null
    )
    {
        parent::__construct();
        if(null !== $tz)
        {
            $this->property('tz', trim($tz));
        }
        $this->_dtval = new TypedSequence('Zimbra\Mail\Struct\DtVal', $dtval);

        $this->on('before', function(Base $sender)
        {
            if($sender->dtval()->count())
            {
                $sender->child('dtval', $sender->dtval()->all());
            }
        });
    }

    /**
     * Gets or sets tz
     *
     * @param  string $tz
     * @return string|self
     */
    public function tz($tz = null)
    {
        if(null === $tz)
        {
            return $this->property('tz');
        }
        return $this->property('tz', trim($tz));
    }

    /**
     * Add dtval
     *
     * @param  DtVal $dtval
     * @return self
     */
    public function addDtVal(DtVal $dtval)
    {
        $this->_dtval->add($dtval);
        return $this;
    }

    /**
     * Gets dtval sequence
     *
     * @return Sequence
     */
    public function dtval()
    {
        return $this->_dtval;
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
