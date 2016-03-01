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
 * DtVal struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DtVal extends Base
{
    /**
     * Constructor method for DtVal
     * @param DtTimeInfo $s Start DATE-TIME
     * @param DtTimeInfo $e End DATE-TIME 
     * @param DurationInfo $dur Duration information
     * @return self
     */
    public function __construct(
        DtTimeInfo $s = null,
        DtTimeInfo $e = null,
        DurationInfo $dur = null
    )
    {
        parent::__construct();
        if($s instanceof DtTimeInfo)
        {
            $this->setChild('s', $s);
        }
        if($e instanceof DtTimeInfo)
        {
            $this->setChild('e', $e);
        }
        if($dur instanceof DurationInfo)
        {
            $this->setChild('dur', $dur);
        }
    }

    /**
     * Gets start time
     *
     * @return DtTimeInfo
     */
    public function getStartTime()
    {
        return $this->getChild('s');
    }

    /**
     * Sets start time
     *
     * @param  DtTimeInfo $s
     * @return self
     */
    public function setStartTime(DtTimeInfo $s)
    {
        return $this->setChild('s', $s);
    }

    /**
     * Gets end time
     *
     * @return DtTimeInfo
     */
    public function getEndTime()
    {
        return $this->getChild('e');
    }

    /**
     * Sets end time
     *
     * @param  DtTimeInfo $e
     * @return self
     */
    public function setEndTime(DtTimeInfo $e)
    {
        return $this->setChild('e', $e);
    }

    /**
     * Gets duration
     *
     * @return DurationInfo
     */
    public function getDuration()
    {
        return $this->getChild('dur');
    }

    /**
     * Sets duration
     *
     * @param  DurationInfo $dur
     * @return self
     */
    public function setDuration(DurationInfo $dur)
    {
        return $this->setChild('dur', $dur);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'dtval')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'dtval')
    {
        return parent::toXml($name);
    }
}