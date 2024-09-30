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
use Zimbra\Common\Enum\{Channel, RecoverAccountOperation};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * RecoverAccountRequest class
 * Recover account request
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RecoverAccountRequest extends SoapRequest
{
    /**
     * operation
     *
     * @var RecoverAccountOperation
     */
    #[Accessor(getter: "getOp", setter: "setOp")]
    #[SerializedName("op")]
    #[XmlAttribute]
    private RecoverAccountOperation $op;

    /**
     * Email
     *
     * @var string
     */
    #[Accessor(getter: "getEmail", setter: "setEmail")]
    #[SerializedName("email")]
    #[Type("string")]
    #[XmlAttribute]
    private $email;

    /**
     * Channel
     *
     * @var Channel
     */
    #[Accessor(getter: "getChannel", setter: "setChannel")]
    #[SerializedName("channel")]
    #[XmlAttribute]
    private ?Channel $channel;

    /**
     * Constructor
     *
     * @param  string $email
     * @param  RecoverAccountOperation $op
     * @param  Channel $channel
     * @return self
     */
    public function __construct(
        string $email = "",
        ?RecoverAccountOperation $op = null,
        ?Channel $channel = null
    ) {
        $this->setEmail($email)->setOp(
            $op ?? RecoverAccountOperation::GET_RECOVERY_ACCOUNT
        );
        $this->channel = $channel;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param  string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get op
     *
     * @return RecoverAccountOperation
     */
    public function getOp(): RecoverAccountOperation
    {
        return $this->op;
    }

    /**
     * Set op
     *
     * @param  RecoverAccountOperation $op
     * @return self
     */
    public function setOp(RecoverAccountOperation $op): self
    {
        $this->op = $op;
        return $this;
    }

    /**
     * Get channel
     *
     * @return Channel
     */
    public function getChannel(): ?Channel
    {
        return $this->channel;
    }

    /**
     * Set channel
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new RecoverAccountEnvelope(new RecoverAccountBody($this));
    }
}
