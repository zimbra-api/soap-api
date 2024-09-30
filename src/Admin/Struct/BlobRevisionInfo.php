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
 * BlobRevisionInfo class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class BlobRevisionInfo
{
    /**
     * Path
     *
     * @Accessor(getter="getPath", setter="setPath")
     * @SerializedName("path")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getPath", setter: "setPath")]
    #[SerializedName("path")]
    #[Type("string")]
    #[XmlAttribute]
    private $path;

    /**
     * File size
     *
     * @Accessor(getter="getFileSize", setter="setFileSize")
     * @SerializedName("fileSize")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getFileSize", setter: "setFileSize")]
    #[SerializedName("fileSize")]
    #[Type("int")]
    #[XmlAttribute]
    private $fileSize;

    /**
     * Revision number
     *
     * @Accessor(getter="getRevision", setter="setRevision")
     * @SerializedName("rev")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getRevision", setter: "setRevision")]
    #[SerializedName("rev")]
    #[Type("int")]
    #[XmlAttribute]
    private $revision;

    /**
     * Set if the blob is stored in an ExternalStoreManager rather than locally in FileBlobStore
     *
     * @Accessor(getter="getExternal", setter="setExternal")
     * @SerializedName("external")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getExternal", setter: "setExternal")]
    #[SerializedName("external")]
    #[Type("bool")]
    #[XmlAttribute]
    private $external;

    /**
     * Constructor
     *
     * @param string $path
     * @param int $fileSize
     * @param int $revision
     * @param bool $external
     * @return self
     */
    public function __construct(
        string $path = "",
        int $fileSize = 0,
        int $revision = 0,
        bool $external = false
    ) {
        $this->setPath($path)
            ->setFileSize($fileSize)
            ->setRevision($revision)
            ->setExternal($external);
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Set path
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
     * Get revision number
     *
     * @return int
     */
    public function getRevision(): int
    {
        return $this->revision;
    }

    /**
     * Set revision number
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
     * Get file size
     *
     * @return int
     */
    public function getFileSize(): int
    {
        return $this->fileSize;
    }

    /**
     * Set file size
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
     * Get external
     *
     * @return bool
     */
    public function getExternal(): bool
    {
        return $this->external;
    }

    /**
     * Set external
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
