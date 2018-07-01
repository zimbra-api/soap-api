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

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * AttachmentIdAttrib struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="content")
 */
class AttachmentIdAttrib
{
    /**
     * @Accessor(getter="getAttachmentId", setter="setAttachmentId")
     * @SerializedName("aid")
     * @Type("string")
     * @XmlAttribute
     */
    private $_aid;

    /**
     * Constructor method for AttachmentIdAttrib
     * @param  string $aid Attachment ID
     * @return self
     */
    public function __construct($aid = NULL)
    {
        if (NULL !== $aid) {
            $this->setAttachmentId($aid);
        }
    }

    /**
     * Gets attachment ID
     *
     * @return string
     */
    public function getAttachmentId()
    {
        return $this->_aid;
    }

    /**
     * Sets attachment ID
     *
     * @param  string $aid
     * @return self
     */
    public function setAttachmentId($aid)
    {
        return $this->_aid = trim($aid);
    }
}
