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
 * BlobSizeInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class BlobSizeInfo
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
    #[Accessor(getter: 'getPath', setter: 'setPath')]
    #[SerializedName(name: 'path')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $path;

    /**
     * Data size
     * 
     * @Accessor(getter="getSize", setter="setSize")
     * @SerializedName("s")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getSize', setter: 'setSize')]
    #[SerializedName(name: 's')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $size;

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
     * @param string $path
     * @param int $size
     * @param int $fileSize
     * @param bool $external
     * @return self
     */
    public function __construct(
        string $path = '',
        int $size = 0,
        int $fileSize = 0,
        bool $external = FALSE
    )
    {
        $this->setPath($path)
             ->setSize($size)
             ->setFileSize($fileSize)
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
     * Get data size
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Set data size
     *
     * @param  int $size
     * @return self
     */
    public function setSize(int $size): self
    {
        $this->size = $size;
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
