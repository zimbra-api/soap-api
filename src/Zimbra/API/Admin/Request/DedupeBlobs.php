<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Enum\DedupAction;
use Zimbra\Soap\Struct\IntIdAttr;

/**
 * DedupeBlobs class
 * Dedupe the blobs having the same digest.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DedupeBlobs extends Request
{
    /**
     * Action to perform - one of start|status|stop
     * @var string
     */
    private $_action;

    /**
     * Volumes
     * @var array
     */
    private $_volumes = array();

    /**
     * Constructor method for DedupeBlobs
     * @param  DedupAction $action
     * @param  array  $volumes
     * @return DedupeBlobs
     */
    public function __construct(DedupAction $action, array $volumes = array())
    {
        parent::__construct();
        $this->_action = $action;
        $this->volumes($volumes);
    }

    /**
     * Gets or sets action
     *
     * @param  DedupAction $action
     * @return DedupAction|DedupeBlobs
     */
    public function action(DedupAction $action = null)
    {
        if(null === $action)
        {
            return $this->_action;
        }
        $this->_action = $action;
        return $this;
    }

    /**
     * Add an attr
     *
     * @param  KeyValuePair $attr
     * @return Attr
     */
    public function addVolume(IntIdAttr $volume)
    {
        $this->_volumes[] = $volume;
        return $this;
    }

    /**
     * Gets or sets attrs
     *
     * @param  array $volumes
     * @return array|Attr
     */
    public function volumes(array $volumes = null)
    {
        if(null === $volumes)
        {
            return $this->_volumes;
        }
        $this->_volumes = array();
        foreach ($volumes as $volume)
        {
            if($volume instanceof IntIdAttr)
            {
                $this->_volumes[] = $volume;
            }
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'action' => (string) $this->_action,
        );
        if(count($this->_volumes))
        {
            $this->array['volume'] = array();
            foreach ($this->_volumes as $volume)
            {
                $volumeArr = $volume->toArray('volume');
                $this->array['volume'][] = $volumeArr['volume'];
            }
        }
        return parent::toArray($this->array);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('action', (string) $this->_action);
        foreach ($this->_volumes as $volume)
        {
            $this->xml->append($volume->toXml('volume'));
        }
        return parent::toXml();
    }
}
