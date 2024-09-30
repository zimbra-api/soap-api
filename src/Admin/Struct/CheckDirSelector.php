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
 * CheckDirSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckDirSelector
{
    /**
     * Full path to the directory
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
     * Whether to create the directory or not if it doesn't exist
     *
     * @Accessor(getter="isCreate", setter="setCreate")
     * @SerializedName("create")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "isCreate", setter: "setCreate")]
    #[SerializedName("create")]
    #[Type("bool")]
    #[XmlAttribute]
    private $create;

    /**
     * Constructor
     *
     * @param string $path
     * @param bool   $create
     * @return self
     */
    public function __construct(string $path = "", ?bool $create = null)
    {
        $this->setPath($path);
        if (null !== $create) {
            $this->setCreate($create);
        }
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
     * Get create flag
     *
     * @return bool
     */
    public function isCreate(): bool
    {
        return $this->create;
    }

    /**
     * Set create flag
     *
     * @param  bool $create
     * @return self
     */
    public function setCreate(bool $create): self
    {
        $this->create = $create;
        return $this;
    }
}
