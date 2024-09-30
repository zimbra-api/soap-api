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
use Zimbra\Common\Enum\GalSearchType;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * AutoCompleteRequest class
 * Auto complete
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AutoCompleteRequest extends SoapRequest
{
    /**
     * Name
     *
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private $name;

    /**
     * type of addresses to auto-complete on
     *
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("t")
     * @Type("Enum<Zimbra\Common\Enum\GalSearchType>")
     * @XmlAttribute
     * Enum<Zimbra\Common\Enum\GalSearchType>
     * @var GalSearchType
     */
    #[Accessor(getter: "getType", setter: "setType")]
    #[SerializedName("t")]
    #[Type("Enum<Zimbra\Common\Enum\GalSearchType>")]
    #[XmlAttribute]
    private ?GalSearchType $type;

    /**
     * Set if the "exp" flag is needed in the response for group entries.  Default is unset.
     *
     * @Accessor(getter="getNeedCanExpand", setter="setNeedCanExpand")
     * @SerializedName("needExp")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getNeedCanExpand", setter: "setNeedCanExpand")]
    #[SerializedName("needExp")]
    #[Type("bool")]
    #[XmlAttribute]
    private $needCanExpand;

    /**
     * Comma separated list of folder IDs
     *
     * @Accessor(getter="getFolderList", setter="setFolderList")
     * @SerializedName("folders")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getFolderList", setter: "setFolderList")]
    #[SerializedName("folders")]
    #[Type("string")]
    #[XmlAttribute]
    private $folderList;

    /**
     * Flag whether to include Global Address Book (GAL)
     *
     * @Accessor(getter="getIncludeGal", setter="setIncludeGal")
     * @SerializedName("includeGal")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getIncludeGal", setter: "setIncludeGal")]
    #[SerializedName("includeGal")]
    #[Type("bool")]
    #[XmlAttribute]
    private $includeGal;

    /**
     * Constructor
     *
     * @param  string $name
     * @param  GalSearchType $type
     * @param  bool $needCanExpand
     * @param  string $folderList
     * @param  bool $includeGal
     * @return self
     */
    public function __construct(
        string $name = "",
        ?GalSearchType $type = null,
        ?bool $needCanExpand = null,
        ?string $folderList = null,
        ?bool $includeGal = null
    ) {
        $this->setName($name);
        $this->type = $type;
        if (null !== $needCanExpand) {
            $this->setNeedCanExpand($needCanExpand);
        }
        if (null !== $folderList) {
            $this->setFolderList($folderList);
        }
        if (null !== $includeGal) {
            $this->setIncludeGal($includeGal);
        }
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get type
     *
     * @return GalSearchType
     */
    public function getType(): ?GalSearchType
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param  GalSearchType $type
     * @return self
     */
    public function setType(GalSearchType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get needCanExpand
     *
     * @return bool
     */
    public function getNeedCanExpand(): ?bool
    {
        return $this->needCanExpand;
    }

    /**
     * Set needCanExpand
     *
     * @param  bool $needCanExpand
     * @return self
     */
    public function setNeedCanExpand(bool $needCanExpand): self
    {
        $this->needCanExpand = $needCanExpand;
        return $this;
    }

    /**
     * Get folderList
     *
     * @return string
     */
    public function getFolderList(): ?string
    {
        return $this->folderList;
    }

    /**
     * Set folderList
     *
     * @param  string $folderList
     * @return self
     */
    public function setFolderList(string $folderList): self
    {
        $this->folderList = $folderList;
        return $this;
    }

    /**
     * Get includeGal
     *
     * @return bool
     */
    public function getIncludeGal(): ?bool
    {
        return $this->includeGal;
    }

    /**
     * Set includeGal
     *
     * @param  bool $includeGal
     * @return self
     */
    public function setIncludeGal(bool $includeGal): self
    {
        $this->includeGal = $includeGal;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new AutoCompleteEnvelope(new AutoCompleteBody($this));
    }
}
