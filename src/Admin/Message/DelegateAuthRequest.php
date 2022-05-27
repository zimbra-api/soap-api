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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Common\Struct\AccountSelector as Account;
use Zimbra\Soap\Request;

/**
 * DelegateAuthRequest request class
 * Used to request a new auth token that is valid for the specified account.
 * The id of the auth token will be the id of the target account, and the requesting admin's id will be stored in
 * the auth token for auditing purposes.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DelegateAuthRequest extends Request
{
    /**
     * Details of target account
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Common\Struct\AccountSelector")
     * @XmlElement
     */
    private Account $account;

    /**
     * Lifetime in seconds of the newly-created authtoken. defaults to 1 hour.
     * Can't be longer then zimbraAuthTokenLifetime.
     * @Accessor(getter="getDuration", setter="setDuration")
     * @SerializedName("duration")
     * @Type("integer")
     * @XmlAttribute
     */
    private $duration;

    /**
     * Constructor method for DelegateAuthRequest
     * 
     * @param  Account $account
     * @param  int     $duration
     * @return self
     */
    public function __construct(Account $account, ?int $duration = NULL)
    {
        $this->setAccount($account);
        if (NULL !== $duration) {
            $this->setDuration($duration);
        }
    }

    /**
     * Sets the account.
     *
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * Sets the account.
     *
     * @param  Account $account
     * @return self
     */
    public function setAccount(Account $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Gets duration
     *
     * @return int
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * Sets duration
     *
     * @param  integer $id
     * @return self
     */
    public function setDuration(int $duration): self
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof DelegateAuthEnvelope)) {
            $this->envelope = new DelegateAuthEnvelope(
                new DelegateAuthBody($this)
            );
        }
    }
}
