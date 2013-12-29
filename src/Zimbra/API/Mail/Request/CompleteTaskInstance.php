<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\CalTZInfo;
use Zimbra\Soap\Struct\DtTimeInfo;

/**
 * CompleteTaskInstance request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CompleteTaskInstance extends Request
{
    /**
     * ID
     * @var string
     */
    private $_id;

    /**
     * Exception ID
     * @var DtTimeInfo
     */
    private $_exceptId;

    /**
     * Timezone information
     * @var CalTZInfo
     */
    private $_tz;

    /**
     * Constructor method for CompleteTaskInstance
     * @param  string $id
     * @param  ExpandedRecurrenceCancel $cancel
     * @param  ExpandedRecurrenceInvite $comp
     * @return self
     */
    public function __construct(
    	$id,
    	DtTimeInfo $exceptId,
    	CalTZInfo $tz = null
	)
    {
        parent::__construct();
        $this->_id = trim($id);
        $this->_exceptId = $exceptId;
        if($tz instanceof CalTZInfo)
        {
            $this->_tz = $tz;
        }
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Gets or sets exceptId
     *
     * @param  DtTimeInfo $exceptId
     * @return DtTimeInfo|self
     */
    public function exceptId(DtTimeInfo $exceptId = null)
    {
        if(null === $exceptId)
        {
            return $this->_exceptId;
        }
        $this->_exceptId = $exceptId;
        return $this;
    }

    /**
     * Gets or sets tz
     *
     * @param  CalTZInfo $tz
     * @return CalTZInfo|self
     */
    public function tz(CalTZInfo $tz = null)
    {
        if(null === $tz)
        {
            return $this->_tz;
        }
        $this->_tz = $tz;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array['id'] = $this->_id;
        $this->array += $this->_exceptId->toArray('exceptId');
        if($this->_tz instanceof CalTZInfo)
        {
            $this->array += $this->_tz->toArray('tz');
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('id', $this->_id);
        $this->xml->append($this->_exceptId->toXml('exceptId'));
        if($this->_tz instanceof CalTZInfo)
        {
            $this->xml->append($this->_tz->toXml('tz'));
        }
        return parent::toXml();
    }
}
