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
 * VCardInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class VCardInfo extends Base
{
    /**
     * Constructor method for VCardInfo
     * @param string $value Inlined VCARD data
     * @param string $mid Message ID. Use in conjunction with {part-identifier}
     * @param string $part Part identifier. Use in conjunction with {message-id}
     * @param string $aid Uploaded attachment ID
     * @return self
     */
    public function __construct(
        $value = null,
        $mid = null,
        $part = null,
        $aid = null
    )
    {
        parent::__construct(trim($value));
        if(null !== $mid)
        {
            $this->property('mid', trim($mid));
        }
        if(null !== $part)
        {
            $this->property('part', trim($part));
        }
        if(null !== $aid)
        {
            $this->property('aid', trim($aid));
        }
    }

    /**
     * Gets or sets mid
     *
     * @param  string $mid
     * @return string|self
     */
    public function mid($mid = null)
    {
        if(null === $mid)
        {
            return $this->property('mid');
        }
        return $this->property('mid', trim($mid));
    }

    /**
     * Gets or sets part
     *
     * @param  string $part
     * @return string|self
     */
    public function part($part = null)
    {
        if(null === $part)
        {
            return $this->property('part');
        }
        return $this->property('part', trim($part));
    }

    /**
     * Gets or sets aid
     *
     * @param  string $aid
     * @return string|self
     */
    public function aid($aid = null)
    {
        if(null === $aid)
        {
            return $this->property('aid');
        }
        return $this->property('aid', trim($aid));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'vcard')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'vcard')
    {
        return parent::toXml($name);
    }
}
