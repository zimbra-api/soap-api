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
use Zimbra\Mail\Struct\NewFolderSpec;
use Zimbra\Common\Soap\{SoapEnvelopeInterface, SoapRequest};

/**
 * CreateFolderRequest class
 * Create folder
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CreateFolderRequest extends SoapRequest
{
    /**
     * New folder specification
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("folder")
     * @Type("Zimbra\Mail\Struct\NewFolderSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private NewFolderSpec $folder;

    /**
     * Constructor method for CreateFolderRequest
     *
     * @param  NewFolderSpec $folder
     * @return self
     */
    public function __construct(NewFolderSpec $folder)
    {
        $this->setFolder($folder);
    }

    /**
     * Gets folder
     *
     * @return NewFolderSpec
     */
    public function getFolder(): NewFolderSpec
    {
        return $this->folder;
    }

    /**
     * Sets folder
     *
     * @param  NewFolderSpec $folder
     * @return self
     */
    public function setFolder(NewFolderSpec $folder): self
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CreateFolderEnvelope(
            new CreateFolderBody($this)
        );
    }
}
