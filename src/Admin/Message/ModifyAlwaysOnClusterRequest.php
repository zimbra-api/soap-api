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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ModifyAlwaysOnClusterRequest class
 * Modify attributes for a alwaysOnCluster
 * Notes:
 * an empty attribute value removes the specified attr
 * this request is by default proxied to the referenced server
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyAlwaysOnClusterRequest extends SoapRequest implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * Zimbra ID
     *
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private $id;

    /**
     * Constructor
     *
     * @param string $id
     * @param array  $attrs
     * @return self
     */
    public function __construct(string $id = "", array $attrs = [])
    {
        $this->setId($id)->setAttrs($attrs);
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ModifyAlwaysOnClusterEnvelope(
            new ModifyAlwaysOnClusterBody($this)
        );
    }
}
