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
 * BlobRevisionInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="blob")
 */
class BlobRevisionInfo
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
     * File size
     * @Accessor(getter="getFileSize", setter="setFileSize")
     * @SerializedName("fileSize")
     * @Type("int")
     * @XmlAttribute
     */
    private $fileSize;

    /**
     * Revision number
     * @Accessor(getter="getRevision", setter="setRevision")
     * @SerializedName("rev")
     * @Type("int")
     * @XmlAttribute
     */
    private $revision;

    /**
     * Set if the blob is stored in an ExternalStoreManager rather than locally in FileBlobStore
     * @Accessor(getter="getExternal", setter="setExternal")
     * @SerializedName("external")
     * @Type("bool")
     * @XmlAttribute
     */
    private $external;

    /**
     * Constructor method for BlobRevisionInfo
     * @param string $path
     * @param int $fileSize
     * @param int $revision
     * @param bool $external
     * @return self
     */
    public function __construct(
        string $path,
        int $fileSize,
        int $revision,
        bool $external
    )
    {
        $this->setPath($path)
             ->setFileSize($fileSize)
             ->setRevision($revision)
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
    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Gets revision number
     *
     * @return int
     */
    public function getRevision(): int
    {
        return $this->revision;
    }

    /**
     * Sets revision number
     *
     * @param  int $revision
     * @return self
     */
    public function setRevision(int $revision): self
    {
        $this->revision = $revision;
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
    public function setFileSize(int $fileSize): self
    {
        $this->fileSize = $fileSize;
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
    public function setExternal(bool $external): self
    {
        $this->external = $external;
        return $this;
    }
}