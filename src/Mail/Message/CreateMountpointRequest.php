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
use Zimbra\Mail\Struct\NewMountpointSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CreateMountpointRequest class
 * Create mountpoint
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateMountpointRequest extends SoapRequest
{
    /**
     * New mountpoint specification
     * 
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("link")
     * @Type("Zimbra\Mail\Struct\NewMountpointSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var NewMountpointSpec
     */
    #[Accessor(getter: "getFolder", setter: "setFolder")]
    #[SerializedName('link')]
    #[Type(NewMountpointSpec::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private NewMountpointSpec $folder;

    /**
     * Constructor
     *
     * @param  NewMountpointSpec $folder
     * @return self
     */
    public function __construct(NewMountpointSpec $folder)
    {
        $this->setFolder($folder);
    }

    /**
     * Get folder
     *
     * @return NewMountpointSpec
     */
    public function getFolder(): NewMountpointSpec
    {
        return $this->folder;
    }

    /**
     * Set folder
     *
     * @param  NewMountpointSpec $folder
     * @return self
     */
    public function setFolder(NewMountpointSpec $folder): self
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CreateMountpointEnvelope(
            new CreateMountpointBody($this)
        );
    }
}
