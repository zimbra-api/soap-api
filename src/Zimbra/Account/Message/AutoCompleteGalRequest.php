<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\GalSearchType;
use Zimbra\Soap\Request;

/**
 * AutoCompleteGalRequest class
 * Perform an autocomplete for a name against the Global Address List
 * The number of entries in the response is limited by Account/COS attribute zimbraContactAutoCompleteMaxResults with
 * default value of 20.
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="AutoCompleteGalRequest", namespace="urn:zimbraAccount")
 */
class AutoCompleteGalRequest extends Request
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Enum\GalSearchType")
     * @XmlAttribute
     */
    private $type;

    /**
     * @Accessor(getter="getNeedCanExpand", setter="setNeedCanExpand")
     * @SerializedName("needExp")
     * @Type("bool")
     * @XmlAttribute
     */
    private $needCanExpand;

    /**
     * @Accessor(getter="getGalAccountId", setter="setGalAccountId")
     * @SerializedName("galAcctId")
     * @Type("string")
     * @XmlAttribute
     */
    private $galAccountId;

    /**
     * @Accessor(getter="getLimit", setter="setLimit")
     * @SerializedName("limit")
     * @Type("integer")
     * @XmlAttribute
     */
    private $limit;

    /**
     * Constructor method for AutoCompleteGal
     * @param  string $name name to test for autocompletion
     * @param  GalSearchType $type type of addresses to auto-complete on
     * @param  bool $needCanExpand flag is needed in the response for group entries
     * @param  string $galAccountId GAL Account ID
     * @param  int $limit the maximum number of results to return
     * @return self
     */
    public function __construct($name, GalSearchType $type = NULL, $needCanExpand = NULL, $galAccountId = NULL, $limit = NULL)
    {
        $this->setName($name);
        if(NULL !== $type) {
            $this->setType($type);
        }
        if(NULL !== $needCanExpand) {
            $this->setNeedCanExpand($needCanExpand);
        }
        if(NULL !== $galAccountId) {
            $this->setGalAccountId($galAccountId);
        }
        if(NULL !== $limit) {
            $this->setLimit($limit);
        }
    }

    /**
     * Gets the name to test for autocompletion
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the name to test for autocompletion
     *
     * @param  string $name
     * @return self
     */
    public function setName($name): self
    {
        $this->name = trim($name);
        return $this;
    }

    /**
     * Gets type of addresses to auto-complete on
     *
     * @return GalSearchType
     */
    public function getType(): GalSearchType
    {
        return $this->type;
    }

    /**
     * Sets type of addresses to auto-complete on
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
     * Gets need can expand
     *
     * @return bool
     */
    public function getNeedCanExpand(): bool
    {
        return $this->needCanExpand;
    }

    /**
     * Sets need can expand
     *
     * @param  bool $needCanExpand
     * @return self
     */
    public function setNeedCanExpand($needCanExpand): self
    {
        $this->needCanExpand = (bool) $needCanExpand;
        return $this;
    }

    /**
     * Gets GAL Account ID
     *
     * @return string
     */
    public function getGalAccountId(): string
    {
        return $this->galAccountId;
    }

    /**
     * Sets GAL Account ID
     *
     * @param  string $galAccountId
     * @return self
     */
    public function setGalAccountId($galAccountId): self
    {
        $this->galAccountId = trim($galAccountId);
        return $this;
    }

    /**
     * Gets the maximum number of results to return
     *
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * Sets the maximum number of results to return
     *
     * @param  int $limit
     * @return self
     */
    public function setLimit($limit): self
    {
        $this->limit = (int) $limit;
        return $this;
    }

    protected function internalInit()
    {
        $this->envelope = new AutoCompleteGalEnvelope(
            NULL,
            new AutoCompleteGalBody($this)
        );
    }
}
