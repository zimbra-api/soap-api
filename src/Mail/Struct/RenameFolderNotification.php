<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * RenameFolderNotification struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 */
class RenameFolderNotification extends ModifyNotification
{
    /**
     * ID of renamed folder
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("id")
     * @Type("int")
     * @XmlAttribute
     */
    private $folderId;

    /**
     * New path of renamed folder
     * @Accessor(getter="getPath", setter="setPath")
     * @SerializedName("path")
     * @Type("string")
     * @XmlAttribute
     */
    private $path;

    /**
     * Constructor method for RenameFolderNotification
     * 
     * @param  int $folderId
     * @param  string $path
     * @param  int $changeBitmask
     * @return self
     */
    public function __construct(int $folderId = 0, string $path = '', int $changeBitmask = 0)
    {
        parent::__construct($changeBitmask);
        $this->setFolderId($folderId)
             ->setPath($path);
    }

    /**
     * Get folder id
     *
     * @return int
     */
    public function getFolderId(): int
    {
        return $this->folderId;
    }

    /**
     * Set folder id
     *
     * @param  int $folderId
     * @return self
     */
    public function setFolderId(int $folderId): self
    {
        $this->folderId = $folderId;
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
}
