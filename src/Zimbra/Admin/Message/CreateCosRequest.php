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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait};
use Zimbra\Soap\Request;

/**
 * CreateCosRequest class
 * Create a Class of Service (COS)
 * Notes:
 * Extra attrs: description, zimbraNotes
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CreateCosRequest")
 */
class CreateCosRequest extends Request implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * Name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $name;

    /**
     * Constructor method for CreateCosRequest
     * @param string  $name
     * @param array  $attrs
     * @return self
     */
    public function __construct(
        $name,
        array $attrs = []
    )
    {
        $this->setName($name)
             ->setAttrs($attrs);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name): self
    {
        $this->name = trim($name);
        return $this;
    }

    protected function internalInit()
    {
        $this->envelope = new CreateCosEnvelope(
            NULL,
            new CreateCosBody($this)
        );
    }
}
