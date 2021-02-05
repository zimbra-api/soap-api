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
 * WaitSetSessionInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="WaitSetSession")
 */
class WaitSetSessionInfo
{
    /**
     * Interest bitmask
     * @Accessor(getter="getInterestMask", setter="setInterestMask")
     * @SerializedName("interestMask")
     * @Type("string")
     * @XmlAttribute
     */
    private $interestMask;

    /**
     * Mailbox change ID
     * @Accessor(getter="getHighestChangeId", setter="setHighestChangeId")
     * @SerializedName("highestChangeId")
     * @Type("integer")
     * @XmlAttribute
     */
    private $highestChangeId;

    /**
     * Last access time
     * @Accessor(getter="getLastAccessTime", setter="setLastAccessTime")
     * @SerializedName("lastAccessTime")
     * @Type("integer")
     * @XmlAttribute
     */
    private $lastAccessTime;

    /**
     * Creation time
     * @Accessor(getter="getCreationTime", setter="setCreationTime")
     * @SerializedName("creationTime")
     * @Type("integer")
     * @XmlAttribute
     */
    private $creationTime;

    /**
     * Session ID
     * @Accessor(getter="getSessionId", setter="setSessionId")
     * @SerializedName("sessionId")
     * @Type("string")
     * @XmlAttribute
     */
    private $sessionId;

    /**
     * Sync Token
     * @Accessor(getter="getToken", setter="setToken")
     * @SerializedName("token")
     * @Type("string")
     * @XmlAttribute
     */
    private $token;

    /**
     * Comma separated list of IDs for folders.
     * @Accessor(getter="getFolderInterests", setter="setFolderInterests")
     * @SerializedName("folderInterests")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderInterests;

    /**
     * Comma separated list of IDs for folders.
     * @Accessor(getter="getChangedFolders", setter="setChangedFolders")
     * @SerializedName("changedFolders")
     * @Type("string")
     * @XmlAttribute
     */
    private $changedFolders;

    /**
     * Constructor method for WaitSetSessionInfo
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
        string $interestMask,
        int $highestChangeId,
        int $lastAccessTime,
        int $creationTime,
        string $sessionId,
        ?string $token = NULL,
        ?string $folderInterests = NULL,
        ?string $changedFolders = NULL
    )
    {
        $this->setInterestMask($interestMask)
             ->setHighestChangeId($highestChangeId)
             ->setLastAccessTime($lastAccessTime)
             ->setCreationTime($creationTime)
             ->setSessionId($sessionId);
        if (NULL !== $token) {
            $this->setToken($token);
        }
        if (NULL !== $folderInterests) {
            $this->setFolderInterests($folderInterests);
        }
        if (NULL !== $changedFolders) {
            $this->setChangedFolders($changedFolders);
        }
    }

    /**
     * Gets interestMask
     *
     * @return string
     */
    public function getInterestMask(): string
    {
        return $this->interestMask;
    }

    /**
     * Sets interestMask
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
     * Gets creationTime
     *
     * @return int
     */
    public function getCreationTime(): int
    {
        return $this->creationTime;
    }

    /**
     * Sets creationTime
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
     * Gets token
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Sets token
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
     * Gets folderInterests
     *
     * @return string
     */
    public function getFolderInterests(): string
    {
        return $this->folderInterests;
    }

    /**
     * Sets folderInterests
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
     * Gets changedFolders
     *
     * @return string
     */
    public function getChangedFolders(): string
    {
        return $this->changedFolders;
    }

    /**
     * Sets changedFolders
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
     * Sets highestChangeId
     *
     * @return int
     */
    public function getHighestChangeId(): int
    {
        return $this->highestChangeId;
    }

    /**
     * Sets highestChangeId
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
     * Sets lastAccessTime
     *
     * @return int
     */
    public function getLastAccessTime(): int
    {
        return $this->lastAccessTime;
    }

    /**
     * Sets lastAccessTime
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
     * Gets sessionId
     *
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * Sets sessionId
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