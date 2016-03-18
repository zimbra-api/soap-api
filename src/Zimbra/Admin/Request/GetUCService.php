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

use Zimbra\Admin\Struct\UcServiceSelector as UcService;
use Zimbra\Struct\AttributeSelectorTrait;
use Zimbra\Struct\AttributeSelector;

/**
 * GetUCService request class
 * Get UC Service.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetUCService extends Base implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Constructor method for GetUCService
     * @param  UcService $ucservice
     * @param  array $attrs
     * @return self
     */
    public function __construct(UcService $ucservice = null, array $attrs = [])
    {
        parent::__construct();
        if($ucservice instanceof UCService)
        {
            $this->setChild('ucservice', $ucservice);
        }

        $this->setAttrs($attrs);
        $this->on('before', function(Base $sender)
        {
            $attrs = $sender->getAttrs();
            if(!empty($attrs))
            {
                $sender->setProperty('attrs', $attrs);
            }
        });
    }

    /**
     * Gets the ucservice.
     *
     * @return UcService
     */
    public function getUcService()
    {
        return $this->getChild('ucservice');
    }

    /**
     * Sets the ucservice.
     *
     * @param  UcService $ucservice
     * @return self
     */
    public function setUcService(UcService $ucservice)
    {
        return $this->setChild('ucservice', $ucservice);
    }
}
