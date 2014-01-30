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
 * RawInvite struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RawInvite extends Base
{
    /**
     * Constructor method for RawInvite
     * @param  string $uid UID
     * @param  string $value Raw iCalendar data
     * @param  string $summary Summary
     * @return self
     */
    public function __construct($uid = null, $value = null, $summary = null)
    {
        parent::__construct(trim($value));
        if(null !== $uid)
        {
            $this->property('uid', trim($uid));
        }
        if(null !== $summary)
        {
            $this->property('summary', trim($summary));
        }
    }

    /**
     * Gets or sets uid
     *
     * @param  string $uid
     * @return string|self
     */
    public function uid($uid = null)
    {
        if(null === $uid)
        {
            return $this->property('uid');
        }
        return $this->property('uid', trim($uid));
    }

    /**
     * Gets or sets summary
     *
     * @param  string $summary
     * @return string|self
     */
    public function summary($summary = null)
    {
        if(null === $summary)
        {
            return $this->property('summary');
        }
        return $this->property('summary', trim($summary));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'content')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $uid
     * @return SimpleXML
     */
    public function toXml($name = 'content')
    {
        return parent::toXml($name);
    }
}
