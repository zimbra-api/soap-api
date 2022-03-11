<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Soap\Request;

/**
 * VerifyStoreManager request class
 * Verify Store Manager
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class VerifyStoreManagerRequest extends Request
{
    /**
     * fileSize
     * @Accessor(getter="getFileSize", setter="setFileSize")
     * @SerializedName("fileSize")
     * @Type("integer")
     * @XmlAttribute
     */
    private $fileSize;

    /**
     * num
     * @Accessor(getter="getNum", setter="setNum")
     * @SerializedName("num")
     * @Type("integer")
     * @XmlAttribute
     */
    private $num;

    /**
     * checkBlobs
     * @Accessor(getter="getCheckBlobs", setter="setCheckBlobs")
     * @SerializedName("checkBlobs")
     * @Type("bool")
     * @XmlAttribute
     */
    private $checkBlobs;

    /**
     * Constructor method for VerifyStoreManagerRequest
     * 
     * @param int  $fileSize
     * @param int  $num
     * @param bool  $checkBlobs
     * @return self
     */
    public function __construct(
        ?int $fileSize = NULL,
        ?int $num = NULL,
        ?bool $checkBlobs = NULL
    )
    {
        if (NULL !== $fileSize) {
            $this->setFileSize($fileSize);
        }
        if (NULL !== $num) {
            $this->setNum($num);
        }
        if (NULL !== $checkBlobs) {
            $this->setCheckBlobs($checkBlobs);
        }
    }

    /**
     * Gets fileSize
     *
     * @return int
     */
    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }

    /**
     * Sets fileSize
     *
     * @param  int $fileSize
     * @return self
     */
    public function setFileSize(int $fileSize): self
    {
        $this->fileSize = $fileSize;
        return $this;
    }

    /**
     * Gets num
     *
     * @return int
     */
    public function getNum(): ?int
    {
        return $this->num;
    }

    /**
     * Sets num
     *
     * @param  int $num
     * @return self
     */
    public function setNum(int $num): self
    {
        $this->num = $num;
        return $this;
    }

    /**
     * Gets checkBlobs
     *
     * @return bool
     */
    public function getCheckBlobs(): ?bool
    {
        return $this->checkBlobs;
    }

    /**
     * Sets checkBlobs
     *
     * @param  bool $checkBlobs
     * @return self
     */
    public function setCheckBlobs(bool $checkBlobs): self
    {
        $this->checkBlobs = $checkBlobs;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof VerifyStoreManagerEnvelope)) {
            $this->envelope = new VerifyStoreManagerEnvelope(
                new VerifyStoreManagerBody($this)
            );
        }
    }
}
