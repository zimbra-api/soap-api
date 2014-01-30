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
            $this->child('s', $s);
        }
        if($e instanceof DtTimeInfo)
        {
            $this->child('e', $e);
        }
        if($dur instanceof DurationInfo)
        {
            $this->child('dur', $dur);
        }
    }

    /**
     * Gets or sets s
     *
     * @param  DtTimeInfo $s
     * @return DtTimeInfo|self
     */
    public function s(DtTimeInfo $s = null)
    {
        if(null === $s)
        {
            return $this->child('s');
        }
        return $this->child('s', $s);
    }

    /**
     * Gets or sets e
     *
     * @param  DtTimeInfo $e
     * @return DtTimeInfo|self
     */
    public function e(DtTimeInfo $e = null)
    {
        if(null === $e)
        {
            return $this->child('e');
        }
        return $this->child('e', $e);
    }

    /**
     * Gets or sets dur
     *
     * @param  DurationInfo $dur
     * @return DurationInfo|self
     */
    public function dur(DurationInfo $dur = null)
    {
        if(null === $dur)
        {
            return $this->child('dur');
        }
        return $this->child('dur', $dur);
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