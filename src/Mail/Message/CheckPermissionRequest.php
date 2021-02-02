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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlList, XmlRoot};
use Zimbra\Mail\Struct\TargetSpec;
use Zimbra\Soap\Request;

/**
 * CheckPermissionRequest class
 * Check if the authed user has the specified right(s) on a target.
 * Note: to be deprecated in Zimbra 9.  Use zimbraAccount CheckRights instead.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CheckPermissionRequest")
 */
class CheckPermissionRequest extends Request
{
    /**
     * Target specification
     * @Accessor(getter="getTarget", setter="setTarget")
     * @SerializedName("target")
     * @Type("Zimbra\Mail\Struct\TargetSpec")
     * @XmlElement
     */
    private $target;

    /**
     * Rights to check
     * 
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("right")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "right")
     */
    private $rights;

    /**
     * Constructor method for CheckPermissionRequest
     *
     * @param  TargetSpec $target
     * @param  array $rights
     * @return self
     */
    public function __construct(?TargetSpec $target = NULL, array $rights = [])
    {
        $this->setRights($rights);
        if ($target instanceof TargetSpec) {
            $this->setTarget($target);
        }
    }

    /**
     * Gets target
     *
     * @return TargetSpec
     */
    public function getTarget(): ?TargetSpec
    {
        return $this->target;
    }

    /**
     * Sets target
     *
     * @param  TargetSpec $target
     * @return self
     */
    public function setTarget(TargetSpec $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Add a right
     *
     * @param  string $right
     * @return self
     */
    public function addRight($right): self
    {
        $right = trim($right);
        if (!empty($right) && !in_array($right, $this->rights)) {
            $this->rights[] = $right;
        }
        return $this;
    }

    /**
     * Sets rights
     *
     * @param  string $rights
     * @return self
     */
    public function setRights(array $rights): self
    {
        $this->rights = [];
        foreach ($rights as $right) {
            $this->addRight($right);
        }
        return $this;
    }

    /**
     * Gets rights
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof CheckPermissionEnvelope)) {
            $this->envelope = new CheckPermissionEnvelope(
                new CheckPermissionBody($this)
            );
        }
    }
}
