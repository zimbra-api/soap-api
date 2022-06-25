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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * AttachmentIdAttrib struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AttachmentIdAttrib
{
    /**
     * Attachment ID
     * @Accessor(getter="getAttachmentId", setter="setAttachmentId")
     * @SerializedName("aid")
     * @Type("string")
     * @XmlAttribute
     */
    private $aid;

    /**
     * Constructor method for AttachmentIdAttrib
     * @param  string $aid
     * @return self
     */
    public function __construct(?string $aid = NULL)
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
    public function setAttachmentId(string $aid): self
    {
        $this->aid = $aid;
        return $this;
    }
}
