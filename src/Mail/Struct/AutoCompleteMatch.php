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
use Zimbra\Common\Enum\AutoCompleteMatchType as MatchType;

/**
 * AutoCompleteMatch class
 * Contains auto-complete match information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AutoCompleteMatch
{
    /**
     * Comma-separated email addresses in case of group
     * 
     * @var string
     */
    #[Accessor(getter: 'getEmail', setter: 'setEmail')]
    #[SerializedName(name: 'email')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $email;

    /**
     * Match type - gal|contact|rankingTable
     * 
     * @var MatchType
     */
    #[Accessor(getter: 'getMatchType', setter: 'setMatchType')]
    #[SerializedName(name: 'type')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\AutoCompleteMatchType>')]
    #[XmlAttribute]
    private $matchType;

    /**
     * Ranking
     * 
     * @var int
     */
    #[Accessor(getter: 'getRanking', setter: 'setRanking')]
    #[SerializedName(name: 'ranking')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $ranking;

    /**
     * Set if the entry is a group
     * 
     * @var bool
     */
    #[Accessor(getter: 'getGroup', setter: 'setGroup')]
    #[SerializedName(name: 'isGroup')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $group;

    /**
     * Set if the user has the right to expand group members.  Returned only if
     * needExp is set in the request and only on group entries (isGroup is set).
     * 
     * @var bool
     */
    #[Accessor(getter: 'getCanExpandGroupMembers', setter: 'setCanExpandGroupMembers')]
    #[SerializedName(name: 'exp')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $canExpandGroupMembers;

    /**
     * Id
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Folder ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolder', setter: 'setFolder')]
    #[SerializedName(name: 'l')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $folder;

    /**
     * String that should be displayed by the client
     * 
     * @var string
     */
    #[Accessor(getter: 'getDisplayName', setter: 'setDisplayName')]
    #[SerializedName(name: 'display')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $displayName;

    /**
     * First Name
     * 
     * @var string
     */
    #[Accessor(getter: 'getFirstName', setter: 'setFirstName')]
    #[SerializedName(name: 'first')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $firstName;

    /**
     * Middle Name
     * 
     * @var string
     */
    #[Accessor(getter: 'getMiddleName', setter: 'setMiddleName')]
    #[SerializedName(name: 'middle')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $middleName;

    /**
     * Last Name
     * 
     * @var string
     */
    #[Accessor(getter: 'getLastName', setter: 'setLastName')]
    #[SerializedName(name: 'last')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $lastName;

    /**
     * Full Name
     * 
     * @var string
     */
    #[Accessor(getter: 'getFullName', setter: 'setFullName')]
    #[SerializedName(name: 'full')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $fullName;

    /**
     * Nick Name
     * 
     * @var string
     */
    #[Accessor(getter: 'getNickname', setter: 'setNickname')]
    #[SerializedName(name: 'nick')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $nickname;

    /**
     * Company Name
     * 
     * @var string
     */
    #[Accessor(getter: 'getCompany', setter: 'setCompany')]
    #[SerializedName(name: 'company')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $company;

    /**
     * FileAs
     * 
     * @var string
     */
    #[Accessor(getter: 'getFileAs', setter: 'setFileAs')]
    #[SerializedName(name: 'fileas')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $fileAs;

    /**
     * Constructor
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
     * Get email
     *
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set email
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
     * Get matchType
     *
     * @return MatchType
     */
    public function getMatchType(): ?MatchType
    {
        return $this->matchType;
    }

    /**
     * Set matchType
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
     * Get ranking
     *
     * @return int
     */
    public function getRanking(): ?int
    {
        return $this->ranking;
    }

    /**
     * Set ranking
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
     * Get group
     *
     * @return bool
     */
    public function getGroup(): ?bool
    {
        return $this->group;
    }

    /**
     * Set group
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
     * Get canExpandGroupMembers
     *
     * @return bool
     */
    public function getCanExpandGroupMembers(): ?bool
    {
        return $this->canExpandGroupMembers;
    }

    /**
     * Set canExpandGroupMembers
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
     * Get id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set id
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
     * Get folder
     *
     * @return string
     */
    public function getFolder(): ?string
    {
        return $this->folder;
    }

    /**
     * Set folder
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
     * Get displayName
     *
     * @return string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * Set displayName
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
     * Get firstName
     *
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Set firstName
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
     * Get middleName
     *
     * @return string
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * Set middleName
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
     * Get lastName
     *
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Set lastName
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
     * Get fullName
     *
     * @return string
     */
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    /**
     * Set fullName
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
     * Get nickname
     *
     * @return string
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * Set nickname
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
     * Get company
     *
     * @return string
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * Set company
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
     * Get fileAs
     *
     * @return string
     */
    public function getFileAs(): ?string
    {
        return $this->fileAs;
    }

    /**
     * Set fileAs
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
