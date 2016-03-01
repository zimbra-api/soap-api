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
            $this->setProperty('uid', trim($uid));
        }
        if(null !== $summary)
        {
            $this->setProperty('summary', trim($summary));
        }
    }

    /**
     * Gets uid
     *
     * @return string
     */
    public function getUid()
    {
        return $this->getProperty('uid');
    }

    /**
     * Sets uid
     *
     * @param  string $uid
     * @return self
     */
    public function setUid($uid)
    {
        return $this->setProperty('uid', trim($uid));
    }

    /**
     * Gets summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->getProperty('summary');
    }

    /**
     * Sets summary
     *
     * @param  string $summary
     * @return self
     */
    public function setSummary($summary)
    {
        return $this->setProperty('summary', trim($summary));
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
