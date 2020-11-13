<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * AttachmentIdAttrib struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
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
    private $aid;

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
    public function getAttachmentId(): ?string
    {
        return $this->aid;
    }

    /**
     * Sets attachment ID
     *
     * @param  string $aid
     * @return self
     */
    public function setAttachmentId($aid): self
    {
        $this->aid = trim($aid);
        return $this;
    }
}
