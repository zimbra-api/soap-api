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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\{Folder, Mountpoint, SearchFolder};
use Zimbra\Common\Struct\SoapResponse;

/**
 * CreateFolderResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateFolderResponse extends SoapResponse
{
    /**
     * Information about created folder
     * 
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("folder")
     * @Type("Zimbra\Mail\Struct\Folder")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var Folder
     */
    #[Accessor(getter: "getFolder", setter: "setFolder")]
    #[SerializedName('folder')]
    #[Type(Folder::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?Folder $folder;

    /**
     * Information about created mountpoint
     * 
     * @Accessor(getter="getMountpoint", setter="setMountpoint")
     * @SerializedName("link")
     * @Type("Zimbra\Mail\Struct\Mountpoint")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var Mountpoint
     */
    #[Accessor(getter: "getMountpoint", setter: "setMountpoint")]
    #[SerializedName('link')]
    #[Type(Mountpoint::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?Mountpoint $mountpoint;

    /**
     * Information about created search folder
     * 
     * @Accessor(getter="getSearchFolder", setter="setSearchFolder")
     * @SerializedName("search")
     * @Type("Zimbra\Mail\Struct\SearchFolder")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var SearchFolder
     */
    #[Accessor(getter: "getSearchFolder", setter: "setSearchFolder")]
    #[SerializedName('search')]
    #[Type(SearchFolder::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?SearchFolder $searchFolder;

    /**
     * Constructor
     *
     * @param  Folder $folder
     * @return self
     */
    public function __construct(?Folder $folder = NULL)
    {
        $this->folder = $this->mountpoint = $this->searchFolder = NULL;
        if ($folder instanceof Mountpoint) {
            $this->setMountpoint($folder);
        }
        else if ($folder instanceof SearchFolder) {
            $this->setSearchFolder($folder);
        }
        else if ($folder instanceof Folder){
            $this->setFolder($folder);
        }
    }

    /**
     * Get mount point
     *
     * @return Mountpoint
     */
    public function getMountpoint(): ?Mountpoint
    {
        return $this->mountpoint;
    }

    /**
     * Set mount point
     *
     * @param  Mountpoint $mountpoint
     * @return self
     */
    public function setMountpoint(Mountpoint $mountpoint): self
    {
        $this->mountpoint = $mountpoint;
        return $this;
    }

    /**
     * Get search folder
     *
     * @return SearchFolder
     */
    public function getSearchFolder(): ?SearchFolder
    {
        return $this->searchFolder;
    }

    /**
     * Set search folder
     *
     * @param  SearchFolder $searchFolder
     * @return self
     */
    public function setSearchFolder(SearchFolder $searchFolder): self
    {
        $this->searchFolder = $searchFolder;
        return $this;
    }

    /**
     * Get folder
     *
     * @return Folder
     */
    public function getFolder(): ?Folder
    {
        return $this->folder;
    }

    /**
     * Set folder
     *
     * @param  Folder $folder
     * @return self
     */
    public function setFolder(Folder $folder): self
    {
        $this->folder = $folder;
        return $this;
    }
}
