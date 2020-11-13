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
 * DirPathInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="directory")
 */
class DirPathInfo
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
     * Flag whether exists
     * @Accessor(getter="isExists", setter="setExists")
     * @SerializedName("exists")
     * @Type("bool")
     * @XmlAttribute
     */
    private $exists;

    /**
     * Flag whether is directory
     * @Accessor(getter="isDirectory", setter="setIsDirectory")
     * @SerializedName("isDirectory")
     * @Type("bool")
     * @XmlAttribute
     */
    private $directory;

    /**
     * Path is readable
     * @Accessor(getter="isReadable", setter="setReadable")
     * @SerializedName("readable")
     * @Type("bool")
     * @XmlAttribute
     */
    private $readable;

    /**
     * Path is writable
     * @Accessor(getter="isWritable", setter="setWritable")
     * @SerializedName("writable")
     * @Type("bool")
     * @XmlAttribute
     */
    private $writable;

    /**
     * Constructor method for DirPathInfo
     * @param string $path
     * @param bool   $exists
     * @param bool   $directory
     * @param bool   $readable
     * @param bool   $writable
     * @return self
     */
    public function __construct($path, $exists, $directory, $readable, $writable)
    {
        $this->setPath($path)
             ->setExists($exists)
             ->setIsDirectory($directory)
             ->setReadable($readable)
             ->setWritable($writable);
    }

    /**
     * Gets the path
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Sets the path
     *
     * @param  string $path
     * @return self
     */
    public function setPath($path): self
    {
        $this->path = trim($path);
        return $this;
    }

    /**
     * Gets exists flag
     *
     * @return bool
     */
    public function isExists(): bool
    {
        return $this->exists;
    }

    /**
     * Sets exists flag
     *
     * @param  bool $exists
     * @return self
     */
    public function setExists($exists): self
    {
        $this->exists = (bool) $exists;
        return $this;
    }

    /**
     * Gets is directory flag
     *
     * @return bool
     */
    public function isDirectory(): bool
    {
        return $this->directory;
    }

    /**
     * Sets is directory flag
     *
     * @param  bool $directory
     * @return self
     */
    public function setIsDirectory($directory): self
    {
        $this->directory = (bool) $directory;
        return $this;
    }

    /**
     * Gets readable flag
     *
     * @return bool
     */
    public function isReadable(): bool
    {
        return $this->readable;
    }

    /**
     * Sets readable flag
     *
     * @param  bool $readable
     * @return self
     */
    public function setReadable($readable): self
    {
        $this->readable = (bool) $readable;
        return $this;
    }

    /**
     * Gets writable flag
     *
     * @return bool
     */
    public function isWritable(): bool
    {
        return $this->writable;
    }

    /**
     * Sets writable flag
     *
     * @param  bool $writable
     * @return self
     */
    public function setWritable($writable): self
    {
        $this->writable = (bool) $writable;
        return $this;
    }
}
