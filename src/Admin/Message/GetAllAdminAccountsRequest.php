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
 * GetAllAdminAccountsRequest class
 * Get all Admin accounts
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAllAdminAccountsRequest extends Request
{
    /**
     * Apply COS [default 1 (true)]
     * @Accessor(getter="isApplyCos", setter="setApplyCos")
     * @SerializedName("applyCos")
     * @Type("bool")
     * @XmlAttribute
     */
    private $applyCos;

    /**
     * Constructor method for GetAllAdminAccountsRequest
     * 
     * @param  bool $applyCos
     * @return self
     */
    public function __construct(?bool $applyCos = NULL)
    {
        if (NULL !== $applyCos) {
            $this->setApplyCos($applyCos);
        }
    }

    /**
     * Gets applyCos
     *
     * @return bool
     */
    public function isApplyCos(): ?bool
    {
        return $this->applyCos;
    }

    /**
     * Sets applyCos
     *
     * @param  bool $applyCos
     * @return self
     */
    public function setApplyCos(bool $applyCos): self
    {
        $this->applyCos = $applyCos;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetAllAdminAccountsEnvelope(
            new GetAllAdminAccountsBody($this)
        );
    }
}
