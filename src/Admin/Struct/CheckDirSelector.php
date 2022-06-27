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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CheckDirSelector
{
    /**
     * Full path to the directory
     * @Accessor(getter="getPath", setter="setPath")
     * @SerializedName("path")
     * @Type("string")
     * @XmlAttribute
     */
    private $path;

    /**
     * Whether to create the directory or not if it doesn't exist
     * @Accessor(getter="isCreate", setter="setCreate")
     * @SerializedName("create")
     * @Type("bool")
     * @XmlAttribute
     */
    private $create;

    /**
     * Constructor method for CheckDirSelector
     * @param string $path
     * @param bool   $create
     * @return self
     */
    public function __construct(string $path = '', ?bool $create = NULL)
    {
        $this->setPath($path);
        if (NULL !== $create) {
            $this->setCreate($create);
        }
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
    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Gets create flag
     *
     * @return bool
     */
    public function isCreate(): bool
    {
        return $this->create;
    }

    /**
     * Sets create flag
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
