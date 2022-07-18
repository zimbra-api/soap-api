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
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * AutoCompleteRequest class
 * Auto complete
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AutoCompleteRequest extends Request
{
    /**
     * Name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * type of addresses to auto-complete on
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("t")
     * @Type("Zimbra\Common\Enum\GalSearchType")
     * @XmlAttribute
     */
    private ?GalSearchType $type = NULL;

    /**
     * Set if the "exp" flag is needed in the response for group entries.  Default is unset.
     * @Accessor(getter="getNeedCanExpand", setter="setNeedCanExpand")
     * @SerializedName("needExp")
     * @Type("bool")
     * @XmlAttribute
     */
    private $needCanExpand;

    /**
     * Comma separated list of folder IDs
     * @Accessor(getter="getFolderList", setter="setFolderList")
     * @SerializedName("folders")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderList;

    /**
     * Flag whether to include Global Address Book (GAL)
     * @Accessor(getter="getIncludeGal", setter="setIncludeGal")
     * @SerializedName("includeGal")
     * @Type("bool")
     * @XmlAttribute
     */
    private $includeGal;

    /**
     * Constructor method for AutoCompleteRequest
     *
     * @param  string $name
     * @param  GalSearchType $type
     * @param  bool $needCanExpand
     * @param  string $folderList
     * @param  bool $includeGal
     * @return self
     */
    public function __construct(
        string $name = '',
        ?GalSearchType $type = NULL,
        ?bool $needCanExpand = NULL,
        ?string $folderList = NULL,
        ?bool $includeGal = NULL
    )
    {
        $this->setName($name);
        if ($type instanceof GalSearchType) {
            $this->setType($type);
        }
        if (NULL !== $needCanExpand) {
            $this->setNeedCanExpand($needCanExpand);
        }
        if (NULL !== $folderList) {
            $this->setFolderList($folderList);
        }
        if (NULL !== $includeGal) {
            $this->setIncludeGal($includeGal);
        }
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
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
     * Gets type
     *
     * @return GalSearchType
     */
    public function getType(): ?GalSearchType
    {
        return $this->type;
    }

    /**
     * Sets type
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
     * Gets needCanExpand
     *
     * @return bool
     */
    public function getNeedCanExpand(): ?bool
    {
        return $this->needCanExpand;
    }

    /**
     * Sets needCanExpand
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
     * Gets folderList
     *
     * @return string
     */
    public function getFolderList(): ?string
    {
        return $this->folderList;
    }

    /**
     * Sets folderList
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
     * Gets includeGal
     *
     * @return bool
     */
    public function getIncludeGal(): ?bool
    {
        return $this->includeGal;
    }

    /**
     * Sets includeGal
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new AutoCompleteEnvelope(
            new AutoCompleteBody($this)
        );
    }
}
