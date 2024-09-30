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
 * CreateCalendarResourceRequest class
 * Create a calendar resource
 * Notes:
 * A calendar resource is a special type of Account.
 * The Create, Delete, Modify, Rename, Get, GetAll, and Search operations are very similar to those of Account.
 * Must specify the displayName and zimbraCalResType attributes
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateCalendarResourceRequest extends SoapRequest implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * New account's name
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
     * New account's password
     *
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("password")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getPassword", setter: "setPassword")]
    #[SerializedName("password")]
    #[Type("string")]
    #[XmlAttribute]
    private $password;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $password
     * @param array  $attrs
     * @return self
     */
    public function __construct(
        string $name = "",
        ?string $password = null,
        array $attrs = []
    ) {
        $this->setName($name)->setAttrs($attrs);
        if (null !== $password) {
            $this->setPassword($password);
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
     * Get password
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CreateCalendarResourceEnvelope(
            new CreateCalendarResourceBody($this)
        );
    }
}
