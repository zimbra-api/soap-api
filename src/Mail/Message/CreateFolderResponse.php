<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Mail\Struct\Folder;
use Zimbra\Mail\Struct\Mountpoint;
use Zimbra\Mail\Struct\SearchFolder;
use Zimbra\Soap\ResponseInterface;

/**
 * CreateFolderResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CreateFolderResponse")
 */
class CreateFolderResponse implements ResponseInterface
{
    /**
     * Information about created folder
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("folder")
     * @Type("Zimbra\Mail\Struct\Folder")
     * @XmlElement
     */
    private $folder;

    /**
     * Information about created mountpoint
     * @Accessor(getter="getMountpoint", setter="setFolder")
     * @SerializedName("link")
     * @Type("Zimbra\Mail\Struct\Mountpoint")
     * @XmlElement
     */
    private $mountpoint;

    /**
     * Information about created search folder
     * @Accessor(getter="getSearchFolder", setter="setFolder")
     * @SerializedName("search")
     * @Type("Zimbra\Mail\Struct\SearchFolder")
     * @XmlElement
     */
    private $searchFolder;

    /**
     * Constructor method for CreateFolderResponse
     *
     * @param  Folder $folder
     * @return self
     */
    public function __construct(?Folder $folder = NULL)
    {
        if ($folder instanceof Folder) {
            $this->setFolder($folder);
        }
    }

    /**
     * Gets mount point
     *
     * @return Mountpoint
     */
    public function getMountpoint(): ?Mountpoint
    {
        return $this->mountpoint;
    }

    /**
     * Gets search folder
     *
     * @return SearchFolder
     */
    public function getSearchFolder(): ?SearchFolder
    {
        return $this->searchFolder;
    }

    /**
     * Gets folder
     *
     * @return Folder
     */
    public function getFolder(): ?Folder
    {
        return $this->folder;
    }

    /**
     * Sets folder
     *
     * @param  Folder $folder
     * @return self
     */
    public function setFolder(Folder $folder): self
    {
        $this->folder = $this->mountpoint = $this->searchFolder = NULL;
        if ($folder instanceof Mountpoint) {
            $this->mountpoint = $folder;
        }
        else if ($folder instanceof SearchFolder) {
            $this->searchFolder = $folder;
        }
        else {
            $this->folder = $folder;
        }
        return $this;
    }
}
