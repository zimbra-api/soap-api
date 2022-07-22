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
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * ModifyCalendarResourceRequest class
 * Modify a calendar resource
 * Notes:
 * an empty attribute value removes the specified attr
 * this request is by default proxied to the resources's home server
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ModifyCalendarResourceRequest extends Request implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * Zimbra ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Constructor method for ModifyCalendarResourceRequest
     * 
     * @param string $id
     * @param array  $attrs
     * @return self
     */
    public function __construct(string $id = '', array $attrs = [])
    {
        $this->setId($id)
             ->setAttrs($attrs);
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets id
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new ModifyCalendarResourceEnvelope(
            new ModifyCalendarResourceBody($this)
        );
    }
}
