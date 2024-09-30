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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AttachmentIdAttrib
{
    /**
     * Attachment ID
     *
     * @var string
     */
    #[Accessor(getter: "getAttachmentId", setter: "setAttachmentId")]
    #[SerializedName("aid")]
    #[Type("string")]
    #[XmlAttribute]
    private $aid;

    /**
     * Constructor
     *
     * @param  string $aid
     * @return self
     */
    public function __construct(?string $aid = null)
    {
        if (null !== $aid) {
            $this->setAttachmentId($aid);
        }
    }

    /**
     * Get attachment ID
     *
     * @return string
     */
    public function getAttachmentId(): ?string
    {
        return $this->aid;
    }

    /**
     * Set attachment ID
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
