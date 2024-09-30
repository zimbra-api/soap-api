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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\SoapResponse;

/**
 * RecordIMAPSessionResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RecordIMAPSessionResponse extends SoapResponse
{
    /**
     * ID of last item created in mailbox
     *
     * @Accessor(getter="getLastItemId", setter="setLastItemId")
     * @SerializedName("id")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getLastItemId", setter: "setLastItemId")]
    #[SerializedName("id")]
    #[Type("int")]
    #[XmlAttribute]
    private $lastItemId;

    /**
     * UUID of the affected Folder
     *
     * @Accessor(getter="getFolderUuid", setter="setFolderUuid")
     * @SerializedName("luuid")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getFolderUuid", setter: "setFolderUuid")]
    #[SerializedName("luuid")]
    #[Type("string")]
    #[XmlAttribute]
    private $folderUuid;

    /**
     * Constructor
     *
     * @param  int $lastItemId
     * @param  string $folderUuid
     * @return self
     */
    public function __construct(int $lastItemId = 0, string $folderUuid = "")
    {
        $this->setLastItemId($lastItemId)->setFolderUuid($folderUuid);
    }

    /**
     * Get lastItemId
     *
     * @return int
     */
    public function getLastItemId(): int
    {
        return $this->lastItemId;
    }

    /**
     * Set lastItemId
     *
     * @param  int $lastItemId
     * @return self
     */
    public function setLastItemId(int $lastItemId): self
    {
        $this->lastItemId = $lastItemId;
        return $this;
    }

    /**
     * Get folderUuid
     *
     * @return string
     */
    public function getFolderUuid(): string
    {
        return $this->folderUuid;
    }

    /**
     * Set folderUuid
     *
     * @param  string $folderUuid
     * @return self
     */
    public function setFolderUuid(string $folderUuid): self
    {
        $this->folderUuid = $folderUuid;
        return $this;
    }
}
