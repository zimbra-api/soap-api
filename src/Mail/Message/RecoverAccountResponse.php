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
use Zimbra\Soap\ResponseInterface;

/**
 * RecoverAccountResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RecoverAccountResponse implements ResponseInterface
{
    /**
     * Recovery account
     * 
     * @Accessor(getter="getRecoveryAccount", setter="setRecoveryAccount")
     * @SerializedName("recoveryAccount")
     * @Type("string")
     * @XmlAttribute
     */
    private $recoveryAccount;

    /**
     * attempts remaining before feature suspension
     * 
     * @Accessor(getter="getRecoveryAttemptsLeft", setter="setRecoveryAttemptsLeft")
     * @SerializedName("recoveryAttemptsLeft")
     * @Type("integer")
     * @XmlAttribute
     */
    private $recoveryAttemptsLeft;

    /**
     * Constructor method for RecoverAccountResponse
     *
     * @param  string $recoveryAccount
     * @param  int $recoveryAttemptsLeft
     * @param  array $errors
     * @return self
     */
    public function __construct(
        ?string $recoveryAccount = NULL,
        ?int $recoveryAttemptsLeft = NULL
    )
    {
        if (NULL !== $recoveryAccount) {
            $this->setRecoveryAccount($recoveryAccount);
        }
        if (NULL !== $recoveryAttemptsLeft) {
            $this->setRecoveryAttemptsLeft($recoveryAttemptsLeft);
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
     * Gets recoveryAttemptsLeft
     *
     * @return int
     */
    public function getRecoveryAttemptsLeft(): ?int
    {
        return $this->recoveryAttemptsLeft;
    }

    /**
     * Sets recoveryAttemptsLeft
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
