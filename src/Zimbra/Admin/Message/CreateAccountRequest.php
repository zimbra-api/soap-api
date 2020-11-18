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
use Zimbra\Soap\{EnvelopeInterface, RequestInterface};

/**
 * CreateAccountRequest class
 * Create account
 * Notes:
 * Accounts without passwords can't be logged into.
 * Name must include domain (uid@name), and domain specified in name must exist.
 * Default value for zimbraAccountStatus is "active".
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CreateAccountRequest")
 */
class CreateAccountRequest implements RequestInterface, AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * New account's name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * New account's password
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("password")
     * @Type("string")
     * @XmlAttribute
     */
    private $password;

    /**
     * Constructor method for CreateAccountRequest
     * @param string  $name
     * @param string  $password
     * @param array  $attrs
     * @return self
     */
    public function __construct(
        $name,
        $password = NULL,
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
    public function setName($name): self
    {
        $this->name = trim($name);
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
    public function setPassword($password): self
    {
        $this->password = trim($password);
        return $this;
    }

    /**
     * Get soap envelope.
     *
     * @return EnvelopeInterface
     */
    public function getEnvelope(): EnvelopeInterface
    {
        return new CreateAccountEnvelope(
            new CreateAccountBody($this)
        );
    }
}
