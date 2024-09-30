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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * DiscoverRightsRequest class
 * Return all targets of the specified rights applicable to the requested account.
 * Notes:
 * 1. This call only discovers grants granted on the designated target type of the specified rights.
 *    It does not return grants granted on target types the rights can inherit from.
 * 2. For sendAs, sendOnBehalfOf, sendAsDistList, sendOnBehalfOfDistList rights, name attribute
 *    is not returned on <target> elements.
 *    Instead, addresses in the target entry's zimbraPrefAllowAddressForDelegatedSender are returned
 *    in <e a="{email-address}"/> elements under the <target> element.
 *    If zimbraPrefAllowAddressForDelegatedSender is not set on the target entry, the entry's primary
 *    email address will be return in the only <e a="{email-address}"/> element under the <target> element.
 * 3. For all other rights, name attribute is always returned on <target> elements,
 *    no <e a="{email-address}"/> will be returned. name attribute contains the entry's primary name.
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DiscoverRightsRequest extends SoapRequest
{
    /**
     * The rights
     *
     * @Accessor(getter="getRights", setter="setRights")
     * @Type("array<string>")
     * @XmlList(inline=true, entry="right", namespace="urn:zimbraAccount")
     *
     * @var array
     */
    #[Accessor(getter: "getRights", setter: "setRights")]
    #[Type("array<string>")]
    #[XmlList(inline: true, entry: "right", namespace: "urn:zimbraAccount")]
    private $rights = [];

    /**
     * Constructor
     *
     * @param  array $rights
     * @return self
     */
    public function __construct(array $rights = [])
    {
        $this->setRights($rights);
    }

    /**
     * Add right
     *
     * @param  string $right
     * @return self
     */
    public function addRight(string $right): self
    {
        if (!empty($right) && !in_array($right, $this->rights)) {
            $this->rights[] = $right;
        }
        return $this;
    }

    /**
     * Set rights
     *
     * @param  array $rights
     * @return self
     */
    public function setRights(array $rights): self
    {
        $this->rights = array_unique(
            array_map(static fn($right) => trim($right), $rights)
        );
        return $this;
    }

    /**
     * Get rights
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new DiscoverRightsEnvelope(new DiscoverRightsBody($this));
    }
}
