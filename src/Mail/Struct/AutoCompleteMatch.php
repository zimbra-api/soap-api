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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

use Zimbra\Enum\AutoCompleteMatchType as MatchType;

/**
 * AutoCompleteMatch class
 * Contains auto-complete match information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="match")
 */
class AutoCompleteMatch
{
    /**
     * Comma-separated email addresses in case of group
     * @Accessor(getter="getEmail", setter="setEmail")
     * @SerializedName("email")
     * @Type("string")
     * @XmlAttribute
     */
    private $email;

    /**
     * Match type - gal|contact|rankingTable
     * @Accessor(getter="getMatchType", setter="setMatchType")
     * @SerializedName("type")
     * @Type("Zimbra\Enum\AutoCompleteMatchType")
     * @XmlAttribute
     */
    private $matchType;

    /**
     * Ranking
     * @Accessor(getter="getRanking", setter="setRanking")
     * @SerializedName("ranking")
     * @Type("integer")
     * @XmlAttribute
     */
    private $ranking;

    /**
     * Set if the entry is a group
     * @Accessor(getter="getGroup", setter="setGroup")
     * @SerializedName("isGroup")
     * @Type("bool")
     * @XmlAttribute
     */
    private $group;

    /**
     * Set if the user has the right to expand group members.  Returned only if
     * needExp is set in the request and only on group entries (isGroup is set).
     * @Accessor(getter="getCanExpandGroupMembers", setter="setCanExpandGroupMembers")
     * @SerializedName("exp")
     * @Type("bool")
     * @XmlAttribute
     */
    private $canExpandGroupMembers;

    /**
     * Id
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Folder ID
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folder;

    /**
     * String that should be displayed by the client
     * @Accessor(getter="getDisplayName", setter="setDisplayName")
     * @SerializedName("display")
     * @Type("string")
     * @XmlAttribute
     */
    private $displayName;

    /**
     * First Name
     * @Accessor(getter="getFirstName", setter="setFirstName")
     * @SerializedName("first")
     * @Type("string")
     * @XmlAttribute
     */
    private $firstName;

    /**
     * Middle Name
     * @Accessor(getter="getMiddleName", setter="setMiddleName")
     * @SerializedName("middle")
     * @Type("string")
     * @XmlAttribute
     */
    private $middleName;

    /**
     * Last Name
     * @Accessor(getter="getLastName", setter="setLastName")
     * @SerializedName("last")
     * @Type("string")
     * @XmlAttribute
     */
    private $lastName;

    /**
     * Full Name
     * @Accessor(getter="getFullName", setter="setFullName")
     * @SerializedName("full")
     * @Type("string")
     * @XmlAttribute
     */
    private $fullName;

    /**
     * Nick Name
     * @Accessor(getter="getNickname", setter="setNickname")
     * @SerializedName("nick")
     * @Type("string")
     * @XmlAttribute
     */
    private $nickname;

    /**
     * Company Name
     * @Accessor(getter="getCompany", setter="setCompany")
     * @SerializedName("company")
     * @Type("string")
     * @XmlAttribute
     */
    private $company;

    /**
     * FileAs
     * @Accessor(getter="getFileAs", setter="setFileAs")
     * @SerializedName("fileas")
     * @Type("string")
     * @XmlAttribute
     */
    private $fileAs;

    /**
     * Constructor method for AutoCompleteMatch
     *
     * @param  string $email
     * @param  MatchType $matchType
     * @param  int $ranking
     * @param  bool $group
     * @param  bool $canExpandGroupMembers
     * @param  string $id
     * @param  string $folder
     * @param  string $displayName
     * @param  string $firstName
     * @param  string $middleName
     * @param  string $lastName
     * @param  string $fullName
     * @param  string $nickname
     * @param  string $company
     * @param  string $fileAs
     * @return self
     */
    public function __construct(
        ?string $email = NULL,
        ?MatchType $matchType = NULL,
        ?int $ranking = NULL,
        ?bool $group = NULL,
        ?bool $canExpandGroupMembers = NULL,
        ?string $id = NULL,
        ?string $folder = NULL,
        ?string $displayName = NULL,
        ?string $firstName = NULL,
        ?string $middleName = NULL,
        ?string $lastName = NULL,
        ?string $fullName = NULL,
        ?string $nickname = NULL,
        ?string $company = NULL,
        ?string $fileAs = NULL
    )
    {
        if (NULL !== $email) {
            $this->setEmail($email);
        }
        if ($matchType instanceof MatchType) {
            $this->setMatchType($matchType);
        }
        if (NULL !== $ranking) {
            $this->setRanking($ranking);
        }
        if (NULL !== $group) {
            $this->setGroup($group);
        }
        if (NULL !== $canExpandGroupMembers) {
            $this->setCanExpandGroupMembers($canExpandGroupMembers);
        }
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $folder) {
            $this->setFolder($folder);
        }
        if (NULL !== $displayName) {
            $this->setDisplayName($displayName);
        }
        if (NULL !== $firstName) {
            $this->setFirstName($firstName);
        }
        if (NULL !== $middleName) {
            $this->setMiddleName($middleName);
        }
        if (NULL !== $lastName) {
            $this->setLastName($lastName);
        }
        if (NULL !== $fullName) {
            $this->setFullName($fullName);
        }
        if (NULL !== $nickname) {
            $this->setNickname($nickname);
        }
        if (NULL !== $company) {
            $this->setCompany($company);
        }
        if (NULL !== $fileAs) {
            $this->setFileAs($fileAs);
        }
    }

    /**
     * Gets email
     *
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Sets email
     *
     * @param  string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Gets matchType
     *
     * @return MatchType
     */
    public function getMatchType(): ?MatchType
    {
        return $this->matchType;
    }

    /**
     * Sets matchType
     *
     * @param  MatchType $matchType
     * @return self
     */
    public function setMatchType(MatchType $matchType): self
    {
        $this->matchType = $matchType;
        return $this;
    }

    /**
     * Gets ranking
     *
     * @return int
     */
    public function getRanking(): ?int
    {
        return $this->ranking;
    }

    /**
     * Sets ranking
     *
     * @param  int $ranking
     * @return self
     */
    public function setRanking(int $ranking): self
    {
        $this->ranking = $ranking;
        return $this;
    }

    /**
     * Gets group
     *
     * @return bool
     */
    public function getGroup(): ?bool
    {
        return $this->group;
    }

    /**
     * Sets group
     *
     * @param  bool $group
     * @return self
     */
    public function setGroup(bool $group): self
    {
        $this->group = $group;
        return $this;
    }

    /**
     * Gets canExpandGroupMembers
     *
     * @return bool
     */
    public function getCanExpandGroupMembers(): ?bool
    {
        return $this->canExpandGroupMembers;
    }

    /**
     * Sets canExpandGroupMembers
     *
     * @param  bool $canExpandGroupMembers
     * @return self
     */
    public function setCanExpandGroupMembers(bool $canExpandGroupMembers): self
    {
        $this->canExpandGroupMembers = $canExpandGroupMembers;
        return $this;
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets folder
     *
     * @return string
     */
    public function getFolder(): ?string
    {
        return $this->folder;
    }

    /**
     * Sets folder
     *
     * @param  string $folder
     * @return self
     */
    public function setFolder(string $folder): self
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * Gets displayName
     *
     * @return string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * Sets displayName
     *
     * @param  string $displayName
     * @return self
     */
    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * Gets firstName
     *
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Sets firstName
     *
     * @param  string $firstName
     * @return self
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Gets middleName
     *
     * @return string
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * Sets middleName
     *
     * @param  string $middleName
     * @return self
     */
    public function setMiddleName(string $middleName): self
    {
        $this->middleName = $middleName;
        return $this;
    }

    /**
     * Gets lastName
     *
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Sets lastName
     *
     * @param  string $lastName
     * @return self
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Gets fullName
     *
     * @return string
     */
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    /**
     * Sets fullName
     *
     * @param  string $fullName
     * @return self
     */
    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * Gets nickname
     *
     * @return string
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * Sets nickname
     *
     * @param  string $nickname
     * @return self
     */
    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * Gets company
     *
     * @return string
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * Sets company
     *
     * @param  string $company
     * @return self
     */
    public function setCompany(string $company): self
    {
        $this->company = $company;
        return $this;
    }

    /**
     * Gets fileAs
     *
     * @return string
     */
    public function getFileAs(): ?string
    {
        return $this->fileAs;
    }

    /**
     * Sets fileAs
     *
     * @param  string $fileAs
     * @return self
     */
    public function setFileAs(string $fileAs): self
    {
        $this->fileAs = $fileAs;
        return $this;
    }
}
