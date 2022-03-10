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
use Zimbra\Soap\Request;

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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DiscoverRightsRequest extends Request
{
    /**
     * The rights
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("right")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "right")
     */
    private $rights;

    /**
     * Constructor method for DiscoverRightsRequest
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
     * @param  array $requests
     * @return self
     */
    public function setRights(array $rights): self
    {
        $this->rights = [];
        foreach ($rights as $target) {
            $this->addRight($target);
        }
        return $this;
    }

    /**
     * Gets rights
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof DiscoverRightsEnvelope)) {
            $this->envelope = new DiscoverRightsEnvelope(
                new DiscoverRightsBody($this)
            );
        }
    }
}
