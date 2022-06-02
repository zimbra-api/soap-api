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
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * UndeployZimletRequest class
 * Undeploy Zimlet
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class UndeployZimletRequest extends Request
{
    /**
     * Zimlet name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Action
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("string")
     * @XmlAttribute
     */
    private $action;

    /**
     * Constructor method for UndeployZimletRequest
     *
     * @param  string $name
     * @param  string $action
     * @return self
     */
    public function __construct(string $name, ?string $action = NULL)
    {
        $this->setName($name);
        if (NULL !== $action) {
            $this->setAction($action);
        }
    }

    /**
     * Gets zimbra name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets zimbra name
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
     * Gets action
     *
     * @return string
     */
    public function getAction(): ?string
    {
        return $this->action;
    }

    /**
     * Sets action
     *
     * @param  string $action
     * @return self
     */
    public function setAction(string $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new UndeployZimletEnvelope(
            new UndeployZimletBody($this)
        );
    }
}
