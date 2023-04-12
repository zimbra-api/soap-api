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
use Zimbra\Common\Struct\{AccountSelector, SoapEnvelopeInterface, SoapRequest};

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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DelegateAuthRequest extends SoapRequest
{
    /**
     * Details of target account
     * 
     * @var AccountSelector
     */
    #[Accessor(getter: 'getAccount', setter: 'setAccount')]
    #[SerializedName('account')]
    #[Type(AccountSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private AccountSelector $account;

    /**
     * Lifetime in seconds of the newly-created authtoken. defaults to 1 hour.
     * Can't be longer then zimbraAuthTokenLifetime.
     * 
     * @var int
     */
    #[Accessor(getter: 'getDuration', setter: 'setDuration')]
    #[SerializedName('duration')]
    #[Type('int')]
    #[XmlAttribute]
    private $duration;

    /**
     * Constructor
     * 
     * @param  AccountSelector $account
     * @param  int $duration
     * @return self
     */
    public function __construct(AccountSelector $account, ?int $duration = NULL)
    {
        $this->setAccount($account);
        if (NULL !== $duration) {
            $this->setDuration($duration);
        }
    }

    /**
     * Set the account.
     *
     * @return AccountSelector
     */
    public function getAccount(): AccountSelector
    {
        return $this->account;
    }

    /**
     * Set the account.
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
     * Get duration
     *
     * @return int
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * Set duration
     *
     * @param  integer $duration
     * @return self
     */
    public function setDuration(int $duration): self
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new DelegateAuthEnvelope(
            new DelegateAuthBody($this)
        );
    }
}
