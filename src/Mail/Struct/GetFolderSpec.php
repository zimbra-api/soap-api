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
 * GetFolderSpec struct class
 * GetFolder input spec
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetFolderSpec
{
    /**
     * Base folder UUID
     * 
     * @var string
     */
    #[Accessor(getter: 'getUuid', setter: 'setUuid')]
    #[SerializedName(name: 'uuid')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $uuid;

    /**
     * Base folder ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolderId', setter: 'setFolderId')]
    #[SerializedName(name: 'l')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $folderId;

    /**
     * Base folder fully qualified path
     * 
     * @var string
     */
    #[Accessor(getter: 'getPath', setter: 'setPath')]
    #[SerializedName(name: 'path')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $path;

    /**
     * Constructor
     * 
     * @param string $uuid
     * @param string $folderId
     * @param string $path
     * @return self
     */
    public function __construct(
        ?string $uuid = NULL, ?string $folderId = NULL, ?string $path = NULL
    )
    {
        if (NULL !== $uuid) {
            $this->setUuid($uuid);
        }
        if (NULL !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (NULL !== $path) {
            $this->setPath($path);
        }
    }

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * Set uuid
     *
     * @param  string $uuid
     * @return self
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * Get the folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Set the folderId
     *
     * @param  string $folderId
     * @return self
     */
    public function setFolderId(string $folderId): self
    {
        $this->folderId = $folderId;
        return $this;
    }

    /**
     * Get the path
     *
     * @return string
     */
    public function getPath(): ?string
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
}
