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
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * ImportContactsResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ImportContactsResponse implements SoapResponseInterface
{
    /**
     * Information about the import process
     * 
     * @Accessor(getter="getContact", setter="setContact")
     * @SerializedName("cn")
     * @Type("Zimbra\Mail\Struct\ImportContact")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?ImportContact $contact = NULL;

    /**
     * Constructor method for ImportContactsResponse
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
     * Gets contact
     *
     * @return ImportContact
     */
    public function getContact(): ?ImportContact
    {
        return $this->contact;
    }

    /**
     * Sets contact
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
