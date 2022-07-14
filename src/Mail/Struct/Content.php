<?php declare(strict_types=1);
/**
 * This file is version of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};

/**
 * Content struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class Content
{
    /**
     * Attachment upload ID of uploaded object to use
     * 
     * @Accessor(getter="getAttachUploadId", setter="setAttachUploadId")
     * @SerializedName("aid")
     * @Type("string")
     * @XmlAttribute
     */
    private $attachUploadId;

    /**
     * Inlined content data.  Ignored if "aid" is specified
     * 
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method
     * 
     * @param string $attachUploadId
     * @param string $value
     * @return self
     */
    public function __construct(
        ?string $attachUploadId = NULL, ?string $value = NULL
    )
    {
        if (NULL !== $attachUploadId) {
            $this->setAttachUploadId($attachUploadId);
        }
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Gets attachUploadId
     *
     * @return string
     */
    public function getAttachUploadId(): ?string
    {
        return $this->attachUploadId;
    }

    /**
     * Sets attachUploadId
     *
     * @param  string $attachUploadId
     * @return self
     */
    public function setAttachUploadId(string $attachUploadId): self
    {
        $this->attachUploadId = $attachUploadId;
        return $this;
    }
}