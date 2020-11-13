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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Soap\Request;

/**
 * CheckLicenseRequest class
 * Perform an autocomplete for a name against the Global Address List
 * The number of entries in the response is limited by Account/COS attribute zimbraContactAutoCompleteMaxResults with
 * default value of 20.
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CheckLicenseRequest", namespace="urn:zimbraAccount")
 */
class CheckLicenseRequest extends Request
{
    /**
     * @Accessor(getter="getFeature", setter="setFeature")
     * @SerializedName("feature")
     * @Type("string")
     * @XmlAttribute
     */
    private $feature;

    /**
     * Constructor method for CheckLicenseRequest
     * @param  string $feature The licensable feature
     * @return self
     */
    public function __construct($feature)
    {
        $this->setFeature($feature);
    }

    /**
     * Gets licensable feature
     *
     * @return string
     */
    public function getFeature(): string
    {
        return $this->feature;
    }

    /**
     * Sets licensable feature
     *
     * @param  string $feature
     * @return self
     */
    public function setFeature($feature): self
    {
        $features = [
            'mapi',
            'mobilesync',
            'isync',
            'smime',
            'bes',
            'ews',
            'touchclient',
        ];
        if (in_array(strtolower((string) $feature), $features)) {
            $this->feature = (string) $feature;
        }
        return $this;
    }

    protected function internalInit()
    {
        $this->envelope = new CheckLicenseEnvelope(
            NULL,
            new CheckLicenseBody($this)
        );
    }
}
