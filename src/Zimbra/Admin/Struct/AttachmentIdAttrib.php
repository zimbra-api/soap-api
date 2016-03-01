<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Struct\Base;

/**
 * AttachmentIdAttrib struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AttachmentIdAttrib extends Base
{
    /**
     * Constructor method for AttachmentIdAttrib
     * @param  string $aid Attachment ID
     * @return self
     */
    public function __construct($aid = null)
    {
        parent::__construct();
        if(null !== $aid)
        {
            $this->setProperty('aid', trim($aid));
        }
    }

    /**
     * Gets attachment ID
     *
     * @return string
     */
    public function getAttachmentId()
    {
        return $this->getProperty('aid');
    }

    /**
     * Sets attachment ID
     *
     * @param  string $aid
     * @return self
     */
    public function setAttachmentId($aid)
    {
        return $this->setProperty('aid', trim($aid));
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
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'content')
    {
        return parent::toXml($name);
    }
}
