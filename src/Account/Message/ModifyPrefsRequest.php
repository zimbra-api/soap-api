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
use Zimbra\Account\Struct\Pref;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ModifyPrefsRequest class
 * Modify Preferences
 * Notes:
 * For multi-value prefs, just add the same attribute with 'n' different values
 * You can also add/subtract single values to/from a multi-value pref by prefixing
 * the preference name with a '+' or '-', respectively in the same way you do when using zmprov.
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ModifyPrefsRequest extends SoapRequest
{
    /**
     * Specify the preferences to be modified
     * @Accessor(getter="getPrefs", setter="setPrefs")
     * @Type("array<Zimbra\Account\Struct\Pref>")
     * @XmlList(inline=true, entry="pref", namespace="urn:zimbraAccount")
     */
    private $prefs = [];

    /**
     * Constructor method for ModifyPrefsRequest
     *
     * @param  array $prefs
     * @return self
     */
    public function __construct(array $prefs = [])
    {
        $this->setPrefs($prefs);
    }

    /**
     * Add a pref
     *
     * @param  Pref $pref
     * @return self
     */
    public function addPref(Pref $pref): self
    {
        $this->prefs[] = $pref;
        return $this;
    }

    /**
     * Set prefs
     *
     * @param  array $prefs
     * @return self
     */
    public function setPrefs(array $prefs): self
    {
        $this->prefs = array_filter($prefs, static fn ($pref) => $pref instanceof Pref);
        return $this;
    }

    /**
     * Gets prefs
     *
     * @return array
     */
    public function getPrefs(): array
    {
        return $this->prefs;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ModifyPrefsEnvelope(
            new ModifyPrefsBody($this)
        );
    }
}
