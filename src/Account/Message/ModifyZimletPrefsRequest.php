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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Account\Struct\ModifyZimletPrefsSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ModifyZimletPrefsRequest class
 * Modify zimlet preferences
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyZimletPrefsRequest extends SoapRequest
{
    /**
     * Zimlet Preference Specifications
     * @Accessor(getter="getZimlets", setter="setZimlets")
     * @Type("array<Zimbra\Account\Struct\ModifyZimletPrefsSpec>")
     * @XmlList(inline=true, entry="zimlet", namespace="urn:zimbraAccount")
     */
    private $zimlets = [];

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
        $this->zimlets = array_filter($zimlets, static fn ($zimlet) => $zimlet instanceof ModifyZimletPrefsSpec);
        return $this;
    }

    /**
     * Get zimlets
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
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ModifyZimletPrefsEnvelope(
            new ModifyZimletPrefsBody($this)
        );
    }
}
