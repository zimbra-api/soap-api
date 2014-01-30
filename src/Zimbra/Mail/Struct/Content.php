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
 * Content struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class Content extends Base
{
    /**
     * Constructor method for AccountACEInfo
     * @param string $value Inlined content data. Ignored if "aid" is specified
     * @param string $aid AttachmentAttachment upload ID of uploaded object to use
     * @return self
     */
    public function __construct(
        $value = null,
        $aid = null
    )
    {
        parent::__construct(trim($value));
        if(null !== $aid)
        {
            $this->property('aid', trim($aid));
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
