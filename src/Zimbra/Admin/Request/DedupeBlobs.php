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

use Zimbra\Admin\Struct\IntIdAttr;
use Zimbra\Common\TypedSequence;
use Zimbra\Enum\DedupAction;

/**
 * DedupeBlobs request class
 * Dedupe the blobs having the same digest.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DedupeBlobs extends Base
{
    /**
     * Volumes
     * @var TypedSequence<IntIdAttr>
     */
    private $_volume;

    /**
     * Constructor method for DedupeBlobs
     * @param  DedupAction $action Action to perform - one of start|status|stop
     * @param  array  $volume Volumes
     * @return DedupeBlobs
     */
    public function __construct(DedupAction $action, array $volume = array())
    {
        parent::__construct();
        $this->property('action', $action);
        $this->_volume = new TypedSequence('Zimbra\Admin\Struct\IntIdAttr', $volume);

        $this->addHook(function($sender)
        {
            $sender->child('volume', $sender->volume()->all());
        });
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
            return $this->property('action');
        }
        return $this->property('action', $action);
    }


    /**
     * Add an attr
     *
     * @param  KeyValuePair $attr
     * @return self
     */
    public function addVolume(IntIdAttr $volume)
    {
        $this->_volume->add($volume);
        return $this;
    }

    /**
     * Gets volume sequence
     *
     * @return Sequence
     */
    public function volume()
    {
        return $this->_volume;
    }
}
