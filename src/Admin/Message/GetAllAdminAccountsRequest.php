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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetAllAdminAccountsRequest class
 * Get all Admin accounts
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllAdminAccountsRequest extends SoapRequest
{
    /**
     * Apply COS [default 1 (true)]
     *
     * @Accessor(getter="isApplyCos", setter="setApplyCos")
     * @SerializedName("applyCos")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "isApplyCos", setter: "setApplyCos")]
    #[SerializedName("applyCos")]
    #[Type("bool")]
    #[XmlAttribute]
    private $applyCos;

    /**
     * Constructor
     *
     * @param  bool $applyCos
     * @return self
     */
    public function __construct(?bool $applyCos = null)
    {
        if (null !== $applyCos) {
            $this->setApplyCos($applyCos);
        }
    }

    /**
     * Get applyCos
     *
     * @return bool
     */
    public function isApplyCos(): ?bool
    {
        return $this->applyCos;
    }

    /**
     * Set applyCos
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetAllAdminAccountsEnvelope(
            new GetAllAdminAccountsBody($this)
        );
    }
}
