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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\ImportContact;
use Zimbra\Common\Struct\SoapResponse;

/**
 * ImportContactsResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ImportContactsResponse extends SoapResponse
{
    /**
     * Information about the import process
     * 
     * @Accessor(getter="getContact", setter="setContact")
     * @SerializedName("cn")
     * @Type("Zimbra\Mail\Struct\ImportContact")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ImportContact
     */
    #[Accessor(getter: "getContact", setter: "setContact")]
    #[SerializedName(name: 'cn')]
    #[Type(name: ImportContact::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $contact;

    /**
     * Constructor
     *
     * @param  ImportContact $contact
     * @return self
     */
    public function __construct(
        ?ImportContact $contact = NULL
    )
    {
        if ($contact instanceof ImportContact) {
            $this->setContact($contact);
        }
    }

    /**
     * Get contact
     *
     * @return ImportContact
     */
    public function getContact(): ?ImportContact
    {
        return $this->contact;
    }

    /**
     * Set contact
     *
     * @param  ImportContact $contact
     * @return self
     */
    public function setContact(ImportContact $contact): self
    {
        $this->contact = $contact;
        return $this;
    }
}
