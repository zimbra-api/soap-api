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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Account\Struct\Signature;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetSignaturesResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetSignaturesResponse extends SoapResponse
{
    /**
     * Signatures
     * 
     * @var array
     */
    #[Accessor(getter: 'getSignatures', setter: 'setSignatures')]
    #[Type('array<Zimbra\Account\Struct\Signature>')]
    #[XmlList(inline: true, entry: 'signature', namespace: 'urn:zimbraAccount')]
    private $signatures = [];

    /**
     * Constructor
     *
     * @param array $signatures
     * @return self
     */
    public function __construct(array $signatures = [])
    {
        $this->setSignatures($signatures);
    }

    /**
     * Set signatures
     *
     * @param  array $signatures
     * @return self
     */
    public function setSignatures(array $signatures): self
    {
        $this->signatures = array_filter(
            $signatures, static fn ($signature) => $signature instanceof Signature
        );
        return $this;
    }

    /**
     * Get signatures
     *
     * @return array
     */
    public function getSignatures(): array
    {
        return $this->signatures;
    }
}
