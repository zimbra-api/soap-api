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
 * ContentSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ContentSpec extends Base
{
    /**
     * Constructor method for ContentSpec
     * @param string $value Inlined content data. Ignored if "aid" or "mid"/"part" specified
     * @param string $aid Attachment upload ID of uploaded object to use
     * @param string $mid Message ID of existing message. Used in conjunction with "part"
     * @param string $part Part identifier. This combined with "mid" identifies a part of an existing message
     * @return self
     */
    public function __construct(
        $value = null,
        $aid = null,
        $mid = null,
        $part = null
    )
    {
        parent::__construct(trim($value));
        if(null !== $aid)
        {
            $this->property('aid', trim($aid));
        }
        if(null !== $mid)
        {
            $this->property('mid', trim($mid));
        }
        if(null !== $part)
        {
            $this->property('part', trim($part));
        }
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
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'content')
    {
        return parent::toXml($name);
    }
}
