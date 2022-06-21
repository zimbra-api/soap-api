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
use Zimbra\Soap\ResponseInterface;

/**
 * GetMailboxMetadataResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetMailboxMetadataResponse implements ResponseInterface
{
    /**
     * Metadata information
     * @Accessor(getter="getMetadata", setter="setMetadata")
     * @SerializedName("meta")
     * @Type("Zimbra\Mail\Struct\MailCustomMetadata")
     * @XmlElement
     */
    private ?MailCustomMetadata $metadata = NULL;

    /**
     * Constructor method for GetMailboxMetadataResponse
     *
     * @param  MailCustomMetadata $metadata
     * @return self
     */
    public function __construct(?MailCustomMetadata $metadata = NULL)
    {
        if ($metadata instanceof MailCustomMetadata) {
            $this->setMetadata($metadata);
        }
    }

    /**
     * Gets metadata
     *
     * @return MailCustomMetadata
     */
    public function getMetadata(): MailCustomMetadata
    {
        return $this->metadata;
    }

    /**
     * Sets metadata
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
