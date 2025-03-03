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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlList
};
use Zimbra\Common\Struct\{
    KeyValuePairs,
    KeyValuePairsTrait,
    SoapEnvelopeInterface,
    SoapRequest
};

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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateDistributionListRequest extends SoapRequest implements KeyValuePairs
{
    use KeyValuePairsTrait;

    /**
     * Name for distribution list
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private string $name;

    /**
     * If 1 (true) then create a dynamic distribution list
     *
     * @var bool
     */
    #[Accessor(getter: "getDynamic", setter: "setDynamic")]
    #[SerializedName("dynamic")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $dynamic = null;

    /**
     * Key value pairs
     *
     * @var array
     */
    #[Accessor(getter: "getKeyValuePairs", setter: "setKeyValuePairs")]
    #[Type("array<Zimbra\Common\Struct\KeyValuePair>")]
    #[XmlList(inline: true, entry: "a", namespace: "urn:zimbraAccount")]
    protected array $keyValuePairs = [];

    /**
     * Constructor
     *
     * @param string $name
     * @param bool   $dynamic
     * @param array  $attrs
     * @return self
     */
    public function __construct(
        string $name = "",
        ?bool $dynamic = null,
        array $attrs = []
    ) {
        $this->setName($name)->setKeyValuePairs($attrs);
        if (null !== $dynamic) {
            $this->setDynamic($dynamic);
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
     * Get dynamic
     *
     * @return bool
     */
    public function getDynamic(): ?bool
    {
        return $this->dynamic;
    }

    /**
     * Set dynamic
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CreateDistributionListEnvelope(
            new CreateDistributionListBody($this)
        );
    }
}
