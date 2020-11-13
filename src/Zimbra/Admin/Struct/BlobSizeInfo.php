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
 * BlobSizeInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="blob")
 */
class BlobSizeInfo
{
    /**
     * Path
     * @Accessor(getter="getPath", setter="setPath")
     * @SerializedName("path")
     * @Type("string")
     * @XmlAttribute
     */
    private $path;

    /**
     * Data size
     * @Accessor(getter="getSize", setter="setSize")
     * @SerializedName("s")
     * @Type("int")
     * @XmlAttribute
     */
    private $size;

    /**
     * File size
     * @Accessor(getter="getFileSize", setter="setFileSize")
     * @SerializedName("fileSize")
     * @Type("int")
     * @XmlAttribute
     */
    private $fileSize;

    /**
     * Set if the blob is stored in an ExternalStoreManager rather than locally in FileBlobStore
     * @Accessor(getter="getExternal", setter="setExternal")
     * @SerializedName("external")
     * @Type("bool")
     * @XmlAttribute
     */
    private $external;

    /**
     * Constructor method for BlobSizeInfo
     * @param string $path
     * @param int $size
     * @param int $fileSize
     * @param bool $external
     * @return self
     */
    public function __construct(
        $path,
        $size,
        $fileSize,
        $external
    )
    {
        $this->setPath($path)
             ->setSize($size)
             ->setFileSize($fileSize)
             ->setExternal($external);
    }

    /**
     * Gets path
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Sets path
     *
     * @param  string $path
     * @return self
     */
    public function setPath($path): self
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Gets data size
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Sets data size
     *
     * @param  int $size
     * @return self
     */
    public function setSize($size): self
    {
        $this->size = (int) $size;
        return $this;
    }

    /**
     * Gets file size
     *
     * @return int
     */
    public function getFileSize(): int
    {
        return $this->fileSize;
    }

    /**
     * Sets file size
     *
     * @param  int $fileSize
     * @return self
     */
    public function setFileSize($fileSize): self
    {
        $this->fileSize = (int) $fileSize;
        return $this;
    }

    /**
     * Gets external
     *
     * @return bool
     */
    public function getExternal(): bool
    {
        return $this->external;
    }

    /**
     * Sets external
     *
     * @param  bool $external
     * @return self
     */
    public function setExternal($external): self
    {
        $this->external = (bool) $external;
        return $this;
    }
}
