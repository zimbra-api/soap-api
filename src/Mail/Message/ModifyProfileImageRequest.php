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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlValue
};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ModifyProfileImageRequest class
 * Modify profile image
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyProfileImageRequest extends SoapRequest
{
    /**
     * Upload ID of uploaded image to use
     *
     * @Accessor(getter="getUploadId", setter="setUploadId")
     * @SerializedName("uid")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getUploadId", setter: "setUploadId")]
    #[SerializedName("uid")]
    #[Type("string")]
    #[XmlAttribute]
    private $uploadId;

    /**
     * Base64 encoded image data
     *
     * @Accessor(getter="getImageB64Data", setter="setImageB64Data")
     * @Type("string")
     * @XmlValue(cdata=false)
     *
     * @var string
     */
    #[Accessor(getter: "getImageB64Data", setter: "setImageB64Data")]
    #[Type("string")]
    #[XmlValue(cdata: false)]
    private $imageB64Data;

    /**
     * Constructor
     *
     * @param  string $uploadId
     * @param  string $imageB64Data
     * @return self
     */
    public function __construct(
        ?string $uploadId = null,
        ?string $imageB64Data = null
    ) {
        if (null !== $uploadId) {
            $this->setUploadId($uploadId);
        }
        if (null !== $imageB64Data) {
            $this->setImageB64Data($imageB64Data);
        }
    }

    /**
     * Get uploadId
     *
     * @return string
     */
    public function getUploadId(): ?string
    {
        return $this->uploadId;
    }

    /**
     * Set uploadId
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
     * Get imageB64Data
     *
     * @return string
     */
    public function getImageB64Data(): ?string
    {
        return $this->imageB64Data;
    }

    /**
     * Set imageB64Data
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ModifyProfileImageEnvelope(
            new ModifyProfileImageBody($this)
        );
    }
}
