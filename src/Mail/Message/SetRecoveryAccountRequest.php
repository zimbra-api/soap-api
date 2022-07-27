<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\{Channel, RecoveryAccountOperation};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * SetRecoveryAccountRequest class
 * Set recover account request
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SetRecoveryAccountRequest extends SoapRequest
{
    /**
     * op can be sendCode, validateCode, resendCode or reset.
     * 
     * @Accessor(getter="getOp", setter="setOp")
     * @SerializedName("op")
     * @Type("Zimbra\Common\Enum\RecoveryAccountOperation")
     * @XmlAttribute
     */
    private RecoveryAccountOperation $op;

    /**
     * recovery account
     * 
     * @Accessor(getter="getRecoveryAccount", setter="setRecoveryAccount")
     * @SerializedName("recoveryAccount")
     * @Type("string")
     * @XmlAttribute
     */
    private $recoveryAccount;

    /**
     * recovery account verification code
     * 
     * @Accessor(getter="getVerificationCode", setter="setVerificationCode")
     * @SerializedName("recoveryAccountVerificationCode")
     * @Type("string")
     * @XmlAttribute
     */
    private $verificationCode;

    /**
     * recovery channel
     * 
     * @Accessor(getter="getChannel", setter="setChannel")
     * @SerializedName("channel")
     * @Type("Zimbra\Common\Enum\Channel")
     * @XmlAttribute
     */
    private ?Channel $channel = NULL;

    /**
     * Constructor method for SetRecoveryAccountRequest
     *
     * @param  RecoveryAccountOperation $op
     * @param  string $recoveryAccount
     * @param  string $verificationCode
     * @param  Channel $channel
     * @return self
     */
    public function __construct(
        ?RecoveryAccountOperation $op = NULL,
        ?string $recoveryAccount = NULL,
        ?string $verificationCode = NULL,
        ?Channel $channel = NULL
    )
    {
        $this->setOp($op ?? RecoveryAccountOperation::SEND_CODE());
        if (NULL !== $recoveryAccount) {
            $this->setRecoveryAccount($recoveryAccount);
        }
        if (NULL !== $verificationCode) {
            $this->setVerificationCode($verificationCode);
        }
        if ($channel instanceof Channel) {
            $this->setChannel($channel);
        }
    }

    /**
     * Gets recoveryAccount
     *
     * @return string
     */
    public function getRecoveryAccount(): ?string
    {
        return $this->recoveryAccount;
    }

    /**
     * Sets recoveryAccount
     *
     * @param  string $recoveryAccount
     * @return self
     */
    public function setRecoveryAccount(string $recoveryAccount): self
    {
        $this->recoveryAccount = $recoveryAccount;
        return $this;
    }

    /**
     * Gets verificationCode
     *
     * @return string
     */
    public function getVerificationCode(): ?string
    {
        return $this->verificationCode;
    }

    /**
     * Sets verificationCode
     *
     * @param  string $verificationCode
     * @return self
     */
    public function setVerificationCode(string $verificationCode): self
    {
        $this->verificationCode = $verificationCode;
        return $this;
    }

    /**
     * Gets op
     *
     * @return RecoveryAccountOperation
     */
    public function getOp(): RecoveryAccountOperation
    {
        return $this->op;
    }

    /**
     * Sets op
     *
     * @param  RecoveryAccountOperation $op
     * @return self
     */
    public function setOp(RecoveryAccountOperation $op): self
    {
        $this->op = $op;
        return $this;
    }

    /**
     * Gets channel
     *
     * @return Channel
     */
    public function getChannel(): ?Channel
    {
        return $this->channel;
    }

    /**
     * Sets channel
     *
     * @param  Channel $channel
     * @return self
     */
    public function setChannel(Channel $channel): self
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SetRecoveryAccountEnvelope(
            new SetRecoveryAccountBody($this)
        );
    }
}
