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
use Zimbra\Common\Struct\SoapResponse;

/**
 * CreateSignatureResponse class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateSignatureResponse extends SoapResponse
{
    /**
     * Information about created signature
     * 
     * @var NameId
     */
    #[Accessor(getter: 'getSignature', setter: 'setSignature')]
    #[SerializedName('signature')]
    #[Type(NameId::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $signature;

    /**
     * Constructor
     *
     * @param NameId $signature
     * @return self
     */
    public function __construct(?NameId $signature = NULL)
    {
        if ($signature instanceof NameId) {
            $this->setSignature($signature);
        }
    }

    /**
     * Get the signature.
     *
     * @return NameId
     */
    public function getSignature(): ?NameId
    {
        return $this->signature;
    }

    /**
     * Set the signature.
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
