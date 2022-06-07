<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Account\Struct\Signature;
use Zimbra\Soap\ResponseInterface;

/**
 * GetSignaturesResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetSignaturesResponse implements ResponseInterface
{
    /**
     * Signatures
     * 
     * @Accessor(getter="getSignatures", setter="setSignatures")
     * @SerializedName("signature")
     * @Type("array<Zimbra\Account\Struct\Signature>")
     * @XmlList(inline = true, entry = "signature")
     */
    private $signatures = [];

    /**
     * Constructor method for GetSignaturesResponse
     *
     * @param array $signatures
     * @return self
     */
    public function __construct(array $signatures = [])
    {
        $this->setSignatures($signatures);
    }

    /**
     * Add signature
     *
     * @param  Signature $signature
     * @return self
     */
    public function addSignature(Signature $signature): self
    {
        $this->signatures[] = $signature;
        return $this;
    }

    /**
     * Sets signatures
     *
     * @param  array $signatures
     * @return self
     */
    public function setSignatures(array $signatures): self
    {
        $this->signatures = array_filter($signatures, static fn($signature) => $signature instanceof Signature);
        return $this;
    }

    /**
     * Gets signatures
     *
     * @return array
     */
    public function getSignatures(): array
    {
        return $this->signatures;
    }
}
