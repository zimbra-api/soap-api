<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CreateDistributionListRequest class
 * Create a distribution list
 * Notes:
 * dynamic - create a dynamic distribution list
 * Extra attrs: description, zimbraNotes
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateDistributionListRequest extends SoapRequest implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * Name for distribution list
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * If 1 (true) then create a dynamic distribution list
     * 
     * @Accessor(getter="getDynamic", setter="setDynamic")
     * @SerializedName("dynamic")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getDynamic', setter: 'setDynamic')]
    #[SerializedName('dynamic')]
    #[Type('bool')]
    #[XmlAttribute]
    private $dynamic;

    /**
     * Constructor
     * 
     * @param string $name
     * @param bool   $dynamic
     * @param array  $attrs
     * @return self
     */
    public function __construct(
        string $name = '', ?bool $dynamic = NULL, array $attrs = []
    )
    {
        $this->setName($name)
             ->setAttrs($attrs);
        if (NULL !== $dynamic) {
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
