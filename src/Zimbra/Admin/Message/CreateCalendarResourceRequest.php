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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait};
use Zimbra\Soap\Request;

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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CreateCalendarResourceRequest")
 */
class CreateCalendarResourceRequest extends Request implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * New account's name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute()
     */
    private $name;

    /**
     * New account's password
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("password")
     * @Type("string")
     * @XmlAttribute()
     */
    private $password;

    /**
     * Constructor method for CreateCalendarResourceRequest
     * @param string  $name
     * @param string  $password
     * @param array  $attrs
     * @return self
     */
    public function __construct(
        string $name,
        ?string $password = NULL,
        array $attrs = []
    )
    {
        $this->setName($name)
             ->setAttrs($attrs);
        if (NULL !== $password) {
            $this->setPassword($password);
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
     * Gets password
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Sets password
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof CreateCalendarResourceEnvelope)) {
            $this->envelope = new CreateCalendarResourceEnvelope(
                new CreateCalendarResourceBody($this)
            );
        }
    }
}
