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
 * UnexpectedBlobInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class UnexpectedBlobInfo
{
    /**
     * Volume ID
     * 
     * @Accessor(getter="getVolumeId", setter="setVolumeId")
     * @SerializedName("volumeId")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getVolumeId', setter: 'setVolumeId')]
    #[SerializedName(name: 'volumeId')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $volumeId;

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
    #[Accessor(getter: 'getPath', setter: 'setPath')]
    #[SerializedName(name: 'path')]
    #[Type(name: 'string')]
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
    #[Accessor(getter: 'getFileSize', setter: 'setFileSize')]
    #[SerializedName(name: 'fileSize')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $fileSize;

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
    #[Accessor(getter: 'getExternal', setter: 'setExternal')]
    #[SerializedName(name: 'external')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $external;

    /**
     * Constructor
     * 
     * @param int $volumeId
     * @param string $path
     * @param int $fileSize
     * @param bool $external
     * @return self
     */
    public function __construct(
        int $volumeId = 0,
        string $path = '',
        int $fileSize = 0,
        bool $external = FALSE
    )
    {
        $this->setVolumeId($volumeId)
             ->setPath($path)
             ->setFileSize($fileSize)
             ->setExternal($external);
    }

    /**
     * Get volume Id
     *
     * @return int
     */
    public function getVolumeId(): int
    {
        return $this->volumeId;
    }

    /**
     * Set volume Id
     *
     * @param  int $volumeId
     * @return self
     */
    public function setVolumeId(int $volumeId): self
    {
        $this->volumeId = $volumeId;
        return $this;
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
