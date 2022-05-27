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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Soap\Request;

/**
 * DeleteZimletRequest class
 * Delete a Zimlet
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DeleteZimletRequest extends Request
{
    /**
     * Zimlet name
     * @Accessor(getter="getZimlet", setter="setZimlet")
     * @SerializedName("zimlet")
     * @Type("Zimbra\Common\Struct\NamedElement")
     * @XmlElement
     */
    private NamedElement $zimlet;

    /**
     * Constructor method for DeleteZimletRequest
     * 
     * @param  NamedElement $zimlet
     * @return self
     */
    public function __construct(NamedElement $zimlet)
    {
        $this->setZimlet($zimlet);
    }

    /**
     * Sets the zimlet.
     *
     * @return NamedElement
     */
    public function getZimlet(): NamedElement
    {
        return $this->zimlet;
    }

    /**
     * Sets the zimlet.
     *
     * @param  NamedElement $zimlet
     * @return self
     */
    public function setZimlet(NamedElement $zimlet): self
    {
        $this->zimlet = $zimlet;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof DeleteZimletEnvelope)) {
            $this->envelope = new DeleteZimletEnvelope(
                new DeleteZimletBody($this)
            );
        }
    }
}
