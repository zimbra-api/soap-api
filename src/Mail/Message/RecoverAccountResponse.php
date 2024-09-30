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
use Zimbra\Common\Struct\SoapResponse;

/**
 * RecoverAccountResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RecoverAccountResponse extends SoapResponse
{
    /**
     * Recovery account
     *
     * @Accessor(getter="getRecoveryAccount", setter="setRecoveryAccount")
     * @SerializedName("recoveryAccount")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getRecoveryAccount", setter: "setRecoveryAccount")]
    #[SerializedName("recoveryAccount")]
    #[Type("string")]
    #[XmlAttribute]
    private $recoveryAccount;

    /**
     * attempts remaining before feature suspension
     *
     * @Accessor(getter="getRecoveryAttemptsLeft", setter="setRecoveryAttemptsLeft")
     * @SerializedName("recoveryAttemptsLeft")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[
        Accessor(
            getter: "getRecoveryAttemptsLeft",
            setter: "setRecoveryAttemptsLeft"
        )
    ]
    #[SerializedName("recoveryAttemptsLeft")]
    #[Type("int")]
    #[XmlAttribute]
    private $recoveryAttemptsLeft;

    /**
     * Constructor
     *
     * @param  string $recoveryAccount
     * @param  int $recoveryAttemptsLeft
     * @return self
     */
    public function __construct(
        ?string $recoveryAccount = null,
        ?int $recoveryAttemptsLeft = null
    ) {
        if (null !== $recoveryAccount) {
            $this->setRecoveryAccount($recoveryAccount);
        }
        if (null !== $recoveryAttemptsLeft) {
            $this->setRecoveryAttemptsLeft($recoveryAttemptsLeft);
        }
    }

    /**
     * Get recoveryAccount
     *
     * @return string
     */
    public function getRecoveryAccount(): ?string
    {
        return $this->recoveryAccount;
    }

    /**
     * Set recoveryAccount
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
     * Get recoveryAttemptsLeft
     *
     * @return int
     */
    public function getRecoveryAttemptsLeft(): ?int
    {
        return $this->recoveryAttemptsLeft;
    }

    /**
     * Set recoveryAttemptsLeft
     *
     * @param  int $recoveryAttemptsLeft
     * @return self
     */
    public function setRecoveryAttemptsLeft(int $recoveryAttemptsLeft): self
    {
        $this->recoveryAttemptsLeft = $recoveryAttemptsLeft;
        return $this;
    }
}
