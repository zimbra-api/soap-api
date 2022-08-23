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
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetMailboxMetadataResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetMailboxMetadataResponse extends SoapResponse
{
    /**
     * Metadata information
     * 
     * @Accessor(getter="getMetadata", setter="setMetadata")
     * @SerializedName("meta")
     * @Type("Zimbra\Mail\Struct\MailCustomMetadata")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var MailCustomMetadata
     */
    #[Accessor(getter: 'getMetadata', setter: 'setMetadata')]
    #[SerializedName('meta')]
    #[Type(MailCustomMetadata::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?MailCustomMetadata $metadata;

    /**
     * Constructor
     *
     * @param  MailCustomMetadata $metadata
     * @return self
     */
    public function __construct(?MailCustomMetadata $metadata = NULL)
    {
        $this->metadata = $metadata;
    }

    /**
     * Get metadata
     *
     * @return MailCustomMetadata
     */
    public function getMetadata(): MailCustomMetadata
    {
        return $this->metadata;
    }

    /**
     * Set metadata
     *
     * @param  MailCustomMetadata $metadata
     * @return self
     */
    public function setMetadata(MailCustomMetadata $metadata): self
    {
        $this->metadata = $metadata;
        return $this;
    }
}
