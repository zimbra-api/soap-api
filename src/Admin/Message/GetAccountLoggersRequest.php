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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Struct\AccountSelector;
use Zimbra\Soap\Request;

/**
 * GetAccountLoggersRequest class
 * Returns custom loggers created for the given account since the last server start.
 * If the request is sent to a server other than the one that the account resides on, it is proxied to the correct server.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAccountLoggersRequest")
 */
class GetAccountLoggersRequest extends Request
{
    /**
     * Deprecated - use account instead
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $id;

    /**
     * Use to select account
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Struct\AccountSelector")
     * @XmlElement
     */
    private $account;

    /**
     * Constructor method for GetAccountLoggersRequest
     * 
     * @param  string $id
     * @param  AccountSelector $account
     * @return self
     */
    public function __construct(?string $id = NULL, ?AccountSelector $account = NULL)
    {
        if (NULL !== $id) {
            $this->setId($id);
        }
        if ($account instanceof AccountSelector) {
            $this->setAccount($account);
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets the account.
     *
     * @return AccountSelector
     */
    public function getAccount(): ?AccountSelector
    {
        return $this->account;
    }

    /**
     * Sets the account.
     *
     * @param  AccountSelector $account
     * @return self
     */
    public function setAccount(AccountSelector $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetAccountLoggersEnvelope)) {
            $this->envelope = new GetAccountLoggersEnvelope(
                new GetAccountLoggersBody($this)
            );
        }
    }
}
