<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

/**
 * GetAllDomains request class
 * Get all Admin accounts.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAllDomains extends Base
{
    /**
     * Apply config flag
     * @var bool
     */
    private $_applyConfig;

    /**
     * Constructor method for GetAllDomains
     * @param  bool $applyConfig
     * @return self
     */
    public function __construct($applyConfig = null)
    {
        parent::__construct();
        if(null !== $applyConfig)
        {
            $this->setProperty('applyConfig', (bool) $applyConfig);
        }
    }

    /**
     * Gets applyConfig
     *
     * @return bool
     */
    public function getApplyConfig()
    {
        return $this->getProperty('applyConfig');
    }

    /**
     * Sets applyConfig
     *
     * @param  bool $applyConfig
     * @return self
     */
    public function setApplyConfig($applyConfig)
    {
        return $this->setProperty('applyConfig', (bool) $applyConfig);;
    }
}
