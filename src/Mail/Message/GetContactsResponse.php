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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Mail\Struct\ContactInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetContactsResponse class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetContactsResponse extends SoapResponse
{
    /**
     * Contact information
     *
     * @var array
     */
    #[Accessor(getter: "getContacts", setter: "setContacts")]
    #[Type("array<Zimbra\Mail\Struct\ContactInfo>")]
    #[XmlList(inline: true, entry: "cn", namespace: "urn:zimbraMail")]
    private array $contacts = [];

    /**
     * Constructor
     *
     * @param  array $contacts
     * @return self
     */
    public function __construct(array $contacts = [])
    {
        $this->setContacts($contacts);
    }

    /**
     * Set contacts
     *
     * @param  array $contacts
     * @return self
     */
    public function setContacts(array $contacts): self
    {
        $this->contacts = array_filter(
            $contacts,
            static fn($cn) => $cn instanceof ContactInfo
        );
        return $this;
    }

    /**
     * Get contacts
     *
     * @return array
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }
}
