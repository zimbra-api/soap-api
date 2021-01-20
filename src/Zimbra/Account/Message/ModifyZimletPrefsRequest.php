<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Account\Struct\ModifyZimletPrefsSpec;
use Zimbra\Soap\Request;

/**
 * ModifyZimletPrefsRequest class
 * Modify Zimlet Preferences
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="ModifyZimletPrefsRequest")
 */
class ModifyZimletPrefsRequest extends Request
{
    /**
     * Zimlet Preference Specifications
     * @Accessor(getter="getZimlets", setter="setZimlets")
     * @SerializedName("zimlet")
     * @Type("array<Zimbra\Account\Struct\ModifyZimletPrefsSpec>")
     * @XmlList(inline = true, entry = "zimlet")
     */
    private $zimlets;

    /**
     * Constructor method for ModifyZimletPrefsRequest
     *
     * @param  array $zimlets
     * @return self
     */
    public function __construct(array $zimlets = [])
    {
        $this->setZimlets($zimlets);
    }

    /**
     * Add a zimlet
     *
     * @param  ModifyZimletPrefsSpec $zimlet
     * @return self
     */
    public function addZimlet(ModifyZimletPrefsSpec $zimlet): self
    {
        $this->zimlets[] = $zimlet;
        return $this;
    }

    /**
     * Set zimlets
     *
     * @param  array $zimlets
     * @return self
     */
    public function setZimlets(array $zimlets): self
    {
        $this->zimlets = [];
        foreach ($zimlets as $zimlet) {
            if ($zimlet instanceof ModifyZimletPrefsSpec) {
                $this->zimlets[] = $zimlet;
            }
        }
        return $this;
    }

    /**
     * Gets zimlets
     *
     * @return array
     */
    public function getZimlets(): array
    {
        return $this->zimlets;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof ModifyZimletPrefsEnvelope)) {
            $this->envelope = new ModifyZimletPrefsEnvelope(
                new ModifyZimletPrefsBody($this)
            );
        }
    }
}
