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
use Zimbra\Admin\Struct\StoreManagerRuntimeSwitchResult;
use Zimbra\Common\Struct\SoapResponse;

/**
 * SetCurrentVolumeResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SetCurrentVolumeResponse extends SoapResponse
{
    /**
     * The runtime switch result
     * 
     * @var StoreManagerRuntimeSwitchResult
     */
    #[Accessor(getter: 'getRuntimeSwitchResult', setter: 'setRuntimeSwitchResult')]
    #[SerializedName('storeManagerRuntimeSwitchResult')]
    #[Type(StoreManagerRuntimeSwitchResult::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?StoreManagerRuntimeSwitchResult $runtimeSwitchResult;

    /**
     * Constructor
     *
     * @param StoreManagerRuntimeSwitchResult $runtimeSwitchResult
     * @return self
     */
    public function __construct(?StoreManagerRuntimeSwitchResult $runtimeSwitchResult = null)
    {
        $this->runtimeSwitchResult = $runtimeSwitchResult;
    }

    /**
     * Get the runtimeSwitchResult.
     *
     * @return StoreManagerRuntimeSwitchResult
     */
    public function getRuntimeSwitchResult(): ?StoreManagerRuntimeSwitchResult
    {
        return $this->runtimeSwitchResult;
    }

    /**
     * Set the runtimeSwitchResult.
     *
     * @param  StoreManagerRuntimeSwitchResult $runtimeSwitchResult
     * @return self
     */
    public function setRuntimeSwitchResult(StoreManagerRuntimeSwitchResult $runtimeSwitchResult): self
    {
        $this->runtimeSwitchResult = $runtimeSwitchResult;
        return $this;
    }
}
