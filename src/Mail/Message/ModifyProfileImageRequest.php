<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * ModifyProfileImageRequest class
 * Modify profile image
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ModifyProfileImageRequest extends Request
{
    /**
     * Upload ID of uploaded image to use
     * 
     * @Accessor(getter="getUploadId", setter="setUploadId")
     * @SerializedName("uid")
     * @Type("string")
     * @XmlAttribute
     */
    private $uploadId;

    /**
     * Base64 encoded image data
     * 
     * @Accessor(getter="getImageB64Data", setter="setImageB64Data")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $imageB64Data;

    /**
     * Constructor method for ModifyProfileImageRequest
     *
     * @param  string $uploadId
     * @param  string $imageB64Data
     * @return self
     */
    public function __construct(
        ?string $uploadId = NULL, ?string $imageB64Data = NULL
    )
    {
        if (NULL !== $uploadId) {
            $this->setUploadId($uploadId);
        }
        if (NULL !== $imageB64Data) {
            $this->setImageB64Data($imageB64Data);
        }
    }

    /**
     * Gets uploadId
     *
     * @return string
     */
    public function getUploadId(): ?string
    {
        return $this->uploadId;
    }

    /**
     * Sets uploadId
     *
     * @param  string $uploadId
     * @return self
     */
    public function setUploadId(string $uploadId): self
    {
        $this->uploadId = $uploadId;
        return $this;
    }

    /**
     * Gets imageB64Data
     *
     * @return string
     */
    public function getImageB64Data(): ?string
    {
        return $this->imageB64Data;
    }

    /**
     * Sets imageB64Data
     *
     * @param  string $imageB64Data
     * @return self
     */
    public function setImageB64Data(string $imageB64Data): self
    {
        $this->imageB64Data = $imageB64Data;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new ModifyProfileImageEnvelope(
            new ModifyProfileImageBody($this)
        );
    }
}
