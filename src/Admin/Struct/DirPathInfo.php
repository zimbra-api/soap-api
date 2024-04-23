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
 * DirPathInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DirPathInfo
{
    /**
     * Path
     * 
     * @var string
     */
    #[Accessor(getter: 'getPath', setter: 'setPath')]
    #[SerializedName('path')]
    #[Type('string')]
    #[XmlAttribute]
    private $path;

    /**
     * Flag whether exists
     * 
     * @var bool
     */
    #[Accessor(getter: 'isExists', setter: 'setExists')]
    #[SerializedName('exists')]
    #[Type('bool')]
    #[XmlAttribute]
    private $exists;

    /**
     * Flag whether is directory
     * 
     * @var bool
     */
    #[Accessor(getter: 'isDirectory', setter: 'setIsDirectory')]
    #[SerializedName('isDirectory')]
    #[Type('bool')]
    #[XmlAttribute]
    private $directory;

    /**
     * Path is readable
     * 
     * @var bool
     */
    #[Accessor(getter: 'isReadable', setter: 'setReadable')]
    #[SerializedName('readable')]
    #[Type('bool')]
    #[XmlAttribute]
    private $readable;

    /**
     * Path is writable
     * 
     * @var bool
     */
    #[Accessor(getter: 'isWritable', setter: 'setWritable')]
    #[SerializedName('writable')]
    #[Type('bool')]
    #[XmlAttribute]
    private $writable;

    /**
     * Constructor
     * 
     * @param string $path
     * @param bool   $exists
     * @param bool   $directory
     * @param bool   $readable
     * @param bool   $writable
     * @return self
     */
    public function __construct(
        string $path = '',
        bool $exists = false,
        bool $directory = false,
        bool $readable = false,
        bool $writable = false
    )
    {
        $this->setPath($path)
             ->setExists($exists)
             ->setIsDirectory($directory)
             ->setReadable($readable)
             ->setWritable($writable);
    }

    /**
     * Get the path
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Set the path
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
     * Get exists flag
     *
     * @return bool
     */
    public function isExists(): bool
    {
        return $this->exists;
    }

    /**
     * Set exists flag
     *
     * @param  bool $exists
     * @return self
     */
    public function setExists(bool $exists): self
    {
        $this->exists = $exists;
        return $this;
    }

    /**
     * Get is directory flag
     *
     * @return bool
     */
    public function isDirectory(): bool
    {
        return $this->directory;
    }

    /**
     * Set is directory flag
     *
     * @param  bool $directory
     * @return self
     */
    public function setIsDirectory(bool $directory): self
    {
        $this->directory = $directory;
        return $this;
    }

    /**
     * Get readable flag
     *
     * @return bool
     */
    public function isReadable(): bool
    {
        return $this->readable;
    }

    /**
     * Set readable flag
     *
     * @param  bool $readable
     * @return self
     */
    public function setReadable(bool $readable): self
    {
        $this->readable = $readable;
        return $this;
    }

    /**
     * Get writable flag
     *
     * @return bool
     */
    public function isWritable(): bool
    {
        return $this->writable;
    }

    /**
     * Set writable flag
     *
     * @param  bool $writable
     * @return self
     */
    public function setWritable(bool $writable): self
    {
        $this->writable = $writable;
        return $this;
    }
}
