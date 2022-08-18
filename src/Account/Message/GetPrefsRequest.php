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
 * GetPrefsRequest class
 * Get preferences for the authenticated account
 * If no <pref> elements are provided, all known prefs are returned in the response.
 * If <pref> elements are provided, only those prefs are returned in the response.
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetPrefsRequest extends SoapRequest
{
    /**
     * If any of these are specified then only get these preferences
     * 
     * @Accessor(getter="getPrefs", setter="setPrefs")
     * @Type("array<Zimbra\Account\Struct\Pref>")
     * @XmlList(inline=true, entry="pref", namespace="urn:zimbraAccount")
     * 
     * @var array
     */
    #[Accessor(getter: 'getPrefs', setter: 'setPrefs')]
    #[Type('array<Zimbra\Account\Struct\Pref>')]
    #[XmlList(inline: true, entry: 'pref', namespace: 'urn:zimbraAccount')]
    private $prefs = [];

    /**
     * Constructor
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
     * Get prefs
     *
     * @return array
     */
    public function getPrefs(): array
    {
        return $this->prefs;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetPrefsEnvelope(
            new GetPrefsBody($this)
        );
    }
}
