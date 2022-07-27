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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};
use Zimbra\Admin\Struct\GalContactInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * CheckGalConfigResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CheckGalConfigResponse implements SoapResponseInterface
{
    /**
     * Code
     * @Accessor(getter="getCode", setter="setCode")
     * @SerializedName("code")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     */
    private $code;

    /**
     * Message
     * @Accessor(getter="getMessage", setter="setMessage")
     * @SerializedName("message")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     */
    private $message;

    /**
     * Information for GAL contacts
     * @Accessor(getter="getGalContacts", setter="setGalContacts")
     * @Type("array<Zimbra\Admin\Struct\GalContactInfo>")
     * @XmlList(inline=true, entry="cn", namespace="urn:zimbraAdmin")
     */
    private $galContacts = [];

    /**
     * Constructor method for CheckGalConfigResponse
     *
     * @param string $code
     * @param string $message
     * @param array $galContacts
     * @return self
     */
    public function __construct(
        string $code = '',
        ?string $message = NULL,
        array $galContacts = []
    )
    {
        $this->setCode($code);
        if (NULL !== $message) {
            $this->setMessage($message);
        }
        $this->setGalContacts($galContacts);
    }

    /**
     * Gets code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Sets code
     *
     * @param  string $code
     * @return self
     */
    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Gets message
     *
     * @return string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Sets message
     *
     * @param  string $message
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Add a GAL contact
     *
     * @param  GalContactInfo $contact
     * @return self
     */
    public function addGalContact(GalContactInfo $contact): self
    {
        $this->galContacts[] = $contact;
        return $this;
    }

    /**
     * Sets GAL contacts
     *
     * @param  array $contacts
     * @return self
     */
    public function setGalContacts(array $contacts): self
    {
        $this->galContacts = array_filter($contacts, static fn ($contact) => $contact instanceof GalContactInfo);
        return $this;
    }

    /**
     * Gets GAL contacts
     *
     * @return array
     */
    public function getGalContacts(): array
    {
        return $this->galContacts;
    }
}
