<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Struct;

use Zimbra\Struct\Base;

/**
 * CallerListEntry struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CallerListEntry extends Base
{
    /**
     * Constructor method for CallerListEntry
     * @param string $pn
     * @param bool $a
     * @return self
     */
    public function __construct($pn, $a)
    {
        parent::__construct();
        $this->property('pn', trim($pn));
        $this->property('a', (bool) $a);
    }

    /**
     * Gets or sets pn
     * Caller number from which the call should be forwarded to the {forward-to} number
     *
     * @param  bool $pn
     * @return bool|self
     */
    public function pn($pn = null)
    {
        if(null === $pn)
        {
            return $this->property('pn');
        }
        return $this->property('pn', trim($pn));
    }

    /**
     * Gets or sets a
     * Flag whether {phone-number} is active in the list - "true" or "false"
     *
     * @param  bool $a
     * @return bool|self
     */
    public function a($a = null)
    {
        if(null === $a)
        {
            return $this->property('a');
        }
        return $this->property('a', (bool) $a);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'phone')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'phone')
    {
        return parent::toXml($name);
    }
}
