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
 * WaitSetSessionInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class WaitSetSessionInfo
{
    /**
     * Interest bitmask
     *
     * @var string
     */
    #[Accessor(getter: "getInterestMask", setter: "setInterestMask")]
    #[SerializedName("interestMask")]
    #[Type("string")]
    #[XmlAttribute]
    private string $interestMask;

    /**
     * Mailbox change ID
     *
     * @var int
     */
    #[Accessor(getter: "getHighestChangeId", setter: "setHighestChangeId")]
    #[SerializedName("highestChangeId")]
    #[Type("int")]
    #[XmlAttribute]
    private int $highestChangeId;

    /**
     * Last access time
     *
     * @var int
     */
    #[Accessor(getter: "getLastAccessTime", setter: "setLastAccessTime")]
    #[SerializedName("lastAccessTime")]
    #[Type("int")]
    #[XmlAttribute]
    private int $lastAccessTime;

    /**
     * Creation time
     *
     * @var int
     */
    #[Accessor(getter: "getCreationTime", setter: "setCreationTime")]
    #[SerializedName("creationTime")]
    #[Type("int")]
    #[XmlAttribute]
    private int $creationTime;

    /**
     * Session ID
     *
     * @var string
     */
    #[Accessor(getter: "getSessionId", setter: "setSessionId")]
    #[SerializedName("sessionId")]
    #[Type("string")]
    #[XmlAttribute]
    private string $sessionId;

    /**
     * Sync Token
     *
     * @var string
     */
    #[Accessor(getter: "getToken", setter: "setToken")]
    #[SerializedName("token")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $token = null;

    /**
     * Comma separated list of IDs for folders.
     *
     * @var string
     */
    #[Accessor(getter: "getFolderInterests", setter: "setFolderInterests")]
    #[SerializedName("folderInterests")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $folderInterests = null;

    /**
     * Comma separated list of IDs for folders.
     *
     * @var string
     */
    #[Accessor(getter: "getChangedFolders", setter: "setChangedFolders")]
    #[SerializedName("changedFolders")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $changedFolders = null;

    /**
     * Constructor
     *
     * @param string $interestMask
     * @param int    $highestChangeId
     * @param int    $lastAccessTime
     * @param int    $creationTime
     * @param string $sessionId
     * @param string $token
     * @param string $folderInterests
     * @param string $changedFolders
     * @return self
     */
    public function __construct(
        string $interestMask = "",
        int $highestChangeId = 0,
        int $lastAccessTime = 0,
        int $creationTime = 0,
        string $sessionId = "",
        ?string $token = null,
        ?string $folderInterests = null,
        ?string $changedFolders = null
    ) {
        $this->setInterestMask($interestMask)
            ->setHighestChangeId($highestChangeId)
            ->setLastAccessTime($lastAccessTime)
            ->setCreationTime($creationTime)
            ->setSessionId($sessionId);
        if (null !== $token) {
            $this->setToken($token);
        }
        if (null !== $folderInterests) {
            $this->setFolderInterests($folderInterests);
        }
        if (null !== $changedFolders) {
            $this->setChangedFolders($changedFolders);
        }
    }

    /**
     * Get interestMask
     *
     * @return string
     */
    public function getInterestMask(): string
    {
        return $this->interestMask;
    }

    /**
     * Set interestMask
     *
     * @param  string $interestMask
     * @return self
     */
    public function setInterestMask(string $interestMask): self
    {
        $this->interestMask = $interestMask;
        return $this;
    }

    /**
     * Get creationTime
     *
     * @return int
     */
    public function getCreationTime(): int
    {
        return $this->creationTime;
    }

    /**
     * Set creationTime
     *
     * @param  int $creationTime
     * @return self
     */
    public function setCreationTime(int $creationTime): self
    {
        $this->creationTime = $creationTime;
        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Set token
     *
     * @param  string $token
     * @return self
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Get folderInterests
     *
     * @return string
     */
    public function getFolderInterests(): string
    {
        return $this->folderInterests;
    }

    /**
     * Set folderInterests
     *
     * @param  string $folderInterests
     * @return self
     */
    public function setFolderInterests(string $folderInterests): self
    {
        $this->folderInterests = $folderInterests;
        return $this;
    }

    /**
     * Get changedFolders
     *
     * @return string
     */
    public function getChangedFolders(): string
    {
        return $this->changedFolders;
    }

    /**
     * Set changedFolders
     *
     * @param  string $changedFolders
     * @return self
     */
    public function setChangedFolders(string $changedFolders): self
    {
        $this->changedFolders = $changedFolders;
        return $this;
    }

    /**
     * Set highestChangeId
     *
     * @return int
     */
    public function getHighestChangeId(): int
    {
        return $this->highestChangeId;
    }

    /**
     * Set highestChangeId
     *
     * @param  int $highestChangeId
     * @return self
     */
    public function setHighestChangeId(int $highestChangeId): self
    {
        $this->highestChangeId = $highestChangeId;
        return $this;
    }

    /**
     * Set lastAccessTime
     *
     * @return int
     */
    public function getLastAccessTime(): int
    {
        return $this->lastAccessTime;
    }

    /**
     * Set lastAccessTime
     *
     * @param  int $lastAccessTime
     * @return self
     */
    public function setLastAccessTime(int $lastAccessTime): self
    {
        $this->lastAccessTime = $lastAccessTime;
        return $this;
    }

    /**
     * Get sessionId
     *
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * Set sessionId
     *
     * @param  string $sessionId
     * @return self
     */
    public function setSessionId(string $sessionId): self
    {
        $this->sessionId = $sessionId;
        return $this;
    }
}
