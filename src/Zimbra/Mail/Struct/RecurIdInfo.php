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
 * RecurIdInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RecurIdInfo extends Base
{
    /**
     * Constructor method for RecurIdInfo
     * @param int $rangeType Recurrence range type
     * @param string $recurId Recurrence ID in format : YYMMDD[THHMMSS[Z]]
     * @param string $tz Timezone name
     * @param string $ridZ Recurrence-id in UTC time zone; used in non-all-day appointments only 
     * @return self
     */
    public function __construct(
        $rangeType,
        $recurId,
        $tz = null,
        $ridZ = null
    )
    {
        parent::__construct();
        $this->property('rangeType', (int) $rangeType);
        $this->property('recurId', trim($recurId));
        if(null !== $tz)
        {
            $this->property('tz', trim($tz));
        }
        if(null !== $ridZ)
        {
            $this->property('ridZ', trim($ridZ));
        }
    }

    /**
     * Gets or sets rangeType
     *
     * @param  int $rangeType
     * @return int|self
     */
    public function rangeType($rangeType = null)
    {
        if(null === $rangeType)
        {
            return $this->property('rangeType');
        }
        return $this->property('rangeType', (int) $rangeType);
    }

    /**
     * Gets or sets recurId
     *
     * @param  string $recurId
     * @return string|self
     */
    public function recurId($recurId = null)
    {
        if(null === $recurId)
        {
            return $this->property('recurId');
        }
        return $this->property('recurId', trim($recurId));
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
     * Gets or sets ridZ
     *
     * @param  string $ridZ
     * @return string|self
     */
    public function ridZ($ridZ = null)
    {
        if(null === $ridZ)
        {
            return $this->property('ridZ');
        }
        return $this->property('ridZ', trim($ridZ));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'recur')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'recur')
    {
        return parent::toXml($name);
    }
}
