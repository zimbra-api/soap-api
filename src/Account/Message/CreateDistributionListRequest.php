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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Account\Struct\AccountKeyValuePairsTrait;
use Zimbra\Soap\Request;
use Zimbra\Struct\KeyValuePairs;

/**
 * CreateDistributionListRequest class
 * Create a Distribution List 
 * Notes:
 * authed account must have the privilege to create dist lists in the domain 
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CreateDistributionListRequest extends Request implements KeyValuePairs
{
    use AccountKeyValuePairsTrait;

    /**
     * Name for distribution list
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * If 1 (true) then create a dynamic distribution list
     * @Accessor(getter="getDynamic", setter="setDynamic")
     * @SerializedName("dynamic")
     * @Type("bool")
     * @XmlAttribute
     */
    private $dynamic;

    /**
     * Constructor method for CreateDistributionListRequest
     * 
     * @param string $name
     * @param bool   $dynamic
     * @param array  $attrs
     * @return self
     */
    public function __construct(
        string $name, ?bool $dynamic = NULL, array $attrs = []
    )
    {
        $this->setName($name)
             ->setKeyValuePairs($attrs);
        if (NULL !== $dynamic) {
            $this->setDynamic($dynamic);
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
     * Gets dynamic
     *
     * @return bool
     */
    public function getDynamic(): ?bool
    {
        return $this->dynamic;
    }

    /**
     * Sets dynamic
     *
     * @param  bool $dynamic
     * @return self
     */
    public function setDynamic(bool $dynamic): self
    {
        $this->dynamic = $dynamic;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof CreateDistributionListEnvelope)) {
            $this->envelope = new CreateDistributionListEnvelope(
                new CreateDistributionListBody($this)
            );
        }
    }
}
