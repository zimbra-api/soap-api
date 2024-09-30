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
use Zimbra\Common\Enum\{ActionGrantRight, GrantGranteeType};

/**
 * Grant struct class
 * A grant
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Grant
{
    /**
     * Rights - Some combination of (r)ead, (w)rite, (i)nsert, (d)elete, (a)dminister, workflow action (x), view (p)rivate, view (f)reebusy, (c)reate subfolder
     *
     * @Accessor(getter="getPerm", setter="setPerm")
     * @SerializedName("perm")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getPerm", setter: "setPerm")]
    #[SerializedName("perm")]
    #[Type("string")]
    #[XmlAttribute]
    private $perm;

    /**
     * Grantee Type - usr | grp | cos | dom | all | pub | guest | key
     *
     * @Accessor(getter="getGranteeType", setter="setGranteeType")
     * @SerializedName("gt")
     * @Type("Enum<Zimbra\Common\Enum\GrantGranteeType>")
     * @XmlAttribute
     *
     * @var GrantGranteeType
     */
    #[Accessor(getter: "getGranteeType", setter: "setGranteeType")]
    #[SerializedName("gt")]
    #[Type("Enum<Zimbra\Common\Enum\GrantGranteeType>")]
    #[XmlAttribute]
    private GrantGranteeType $granteeType;

    /**
     * Grantee ID
     *
     * @Accessor(getter="getGranteeId", setter="setGranteeId")
     * @SerializedName("zid")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getGranteeId", setter: "setGranteeId")]
    #[SerializedName("zid")]
    #[Type("string")]
    #[XmlAttribute]
    private $granteeId;

    /**
     * Time when this grant expires
     *
     * @Accessor(getter="getExpiry", setter="setExpiry")
     * @SerializedName("expiry")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getExpiry", setter: "setExpiry")]
    #[SerializedName("expiry")]
    #[Type("int")]
    #[XmlAttribute]
    private $expiry;

    /**
     * Name or email address of the principal being granted rights.
     *
     * @Accessor(getter="getGranteeName", setter="setGranteeName")
     * @SerializedName("d")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getGranteeName", setter: "setGranteeName")]
    #[SerializedName("d")]
    #[Type("string")]
    #[XmlAttribute]
    private $granteeName;

    /**
     * Password for when granteeType is guest
     *
     * @Accessor(getter="getGuestPassword", setter="setGuestPassword")
     * @SerializedName("pw")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getGuestPassword", setter: "setGuestPassword")]
    #[SerializedName("pw")]
    #[Type("string")]
    #[XmlAttribute]
    private $guestPassword;

    /**
     * Access key when granteeType is key
     *
     * @Accessor(getter="getAccessKey", setter="setAccessKey")
     * @SerializedName("key")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getAccessKey", setter: "setAccessKey")]
    #[SerializedName("key")]
    #[Type("string")]
    #[XmlAttribute]
    private $accessKey;

    /**
     * Constructor
     *
     * @param string $perm
     * @param GrantGranteeType $granteeType
     * @param string $granteeId
     * @param int $expiry
     * @param string $granteeName
     * @param string $guestPassword
     * @param string $accessKey
     * @return self
     */
    public function __construct(
        string $perm = "",
        ?GrantGranteeType $granteeType = null,
        string $granteeId = "",
        ?int $expiry = null,
        ?string $granteeName = null,
        ?string $guestPassword = null,
        ?string $accessKey = null
    ) {
        $this->setPerm($perm)
            ->setGranteeType($granteeType ?? new GrantGranteeType("all"))
            ->setGranteeId($granteeId);
        if (null !== $expiry) {
            $this->setExpiry($expiry);
        }
        if (null !== $granteeName) {
            $this->setGranteeName($granteeName);
        }
        if (null !== $guestPassword) {
            $this->setGuestPassword($guestPassword);
        }
        if (null !== $accessKey) {
            $this->setAccessKey($accessKey);
        }
    }

    /**
     * Get perm
     *
     * @return string
     */
    public function getPerm(): string
    {
        return $this->perm;
    }

    /**
     * Set perm
     *
     * @param  string $perm
     * @return self
     */
    public function setPerm(string $perm): self
    {
        $validRights = [];
        foreach (str_split($perm) as $right) {
            if (
                ActionGrantRight::isValid($right) &&
                !in_array($right, $validRights)
            ) {
                $validRights[] = $right;
            }
        }
        $this->perm = implode($validRights);
        return $this;
    }

    /**
     * Get the type of grantee
     *
     * @return GrantGranteeType
     */
    public function getGranteeType(): GrantGranteeType
    {
        return $this->granteeType;
    }

    /**
     * Set the type of grantee
     *
     * @param  GrantGranteeType $granteeType
     * @return self
     */
    public function setGranteeType(GrantGranteeType $granteeType): self
    {
        $this->granteeType = $granteeType;
        return $this;
    }

    /**
     * Get grantee Id
     *
     * @return string
     */
    public function getGranteeId(): string
    {
        return $this->granteeId;
    }

    /**
     * Set grantee Id
     *
     * @param  string $granteeId
     * @return self
     */
    public function setGranteeId(string $granteeId): self
    {
        $this->granteeId = $granteeId;
        return $this;
    }

    /**
     * Get grantee name
     *
     * @return string
     */
    public function getGranteeName(): ?string
    {
        return $this->granteeName;
    }

    /**
     * Set grantee name
     *
     * @param  string $granteeName
     * @return self
     */
    public function setGranteeName(string $granteeName): self
    {
        $this->granteeName = $granteeName;
        return $this;
    }

    /**
     * Get access key
     *
     * @return string
     */
    public function getAccessKey(): ?string
    {
        return $this->accessKey;
    }

    /**
     * Set access key
     *
     * @param  string $accessKey
     * @return self
     */
    public function setAccessKey(string $accessKey): self
    {
        $this->accessKey = $accessKey;
        return $this;
    }

    /**
     * Get guest password
     *
     * @return string
     */
    public function getGuestPassword(): ?string
    {
        return $this->guestPassword;
    }

    /**
     * Set guest password
     *
     * @param  string $guestPassword
     * @return self
     */
    public function setGuestPassword(string $guestPassword): self
    {
        $this->guestPassword = $guestPassword;
        return $this;
    }

    /**
     * Get expiry
     *
     * @return int
     */
    public function getExpiry(): ?int
    {
        return $this->expiry;
    }

    /**
     * Set expiry
     *
     * @param  int $expiry
     * @return self
     */
    public function setExpiry(int $expiry): self
    {
        $this->expiry = $expiry;
        return $this;
    }
}
