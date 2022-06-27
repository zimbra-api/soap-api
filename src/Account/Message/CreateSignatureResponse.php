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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Account\Struct\NameId;
use Zimbra\Soap\ResponseInterface;

/**
 * CreateSignatureResponse class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CreateSignatureResponse implements ResponseInterface
{
    /**
     * Information about created signature
     * @Accessor(getter="getSignature", setter="setSignature")
     * @SerializedName("signature")
     * @Type("Zimbra\Account\Struct\NameId")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private NameId $signature;

    /**
     * Constructor method for CreateSignatureResponse
     *
     * @param NameId $signature
     * @return self
     */
    public function __construct(NameId $signature)
    {
        $this->setSignature($signature);
    }

    /**
     * Gets the signature.
     *
     * @return NameId
     */
    public function getSignature(): NameId
    {
        return $this->signature;
    }

    /**
     * Sets the signature.
     *
     * @param  NameId $signature
     * @return self
     */
    public function setSignature(NameId $signature): self
    {
        $this->signature = $signature;
        return $this;
    }
}
