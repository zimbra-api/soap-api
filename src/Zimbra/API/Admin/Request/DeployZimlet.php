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
use Zimbra\Soap\Struct\AttachmentIdAttrib as Attachment;

/**
 * DeployZimlet class
 * Deploy Zimlet(s).
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeployZimlet extends Request
{
    /**
     * Action - valid values : deployAll|deployLocal|status
     * @var string
     */
    private $_action;

    /**
     * The content
     * @var Attachment
     */
    private $_content;

    /**
     * Flag whether to flush the cache
     * @var boolean
     */
    private $_flush;

    /**
     * Synchronous flag
     * @var boolean
     */
    private $_synchronous;

    private static $_validActions = array('deployAll', 'deployLocal', 'status');

    /**
     * Constructor method for DeployZimlet
     * @param string $action
     * @param Attachment $content
     * @param bool $flush
     * @param bool $synchronous
     * @return self
     */
    public function __construct(
        $action,
        Attachment $content = null,
        $flush = null,
        $synchronous = null
    )
    {
        parent::__construct();
        if(in_array(trim($action), self::$_validActions))
        {
            $this->_action = trim($action);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid action');
        }
        if($content instanceof Attachment)
        {
            $this->_content = $content;
        }
        if(null !== $flush)
        {
            $this->_flush = (bool) $flush;
        }
        if(null !== $synchronous)
        {
            $this->_synchronous = (bool) $synchronous;
        }
    }

    /**
     * Gets or sets action
     *
     * @param  string $action
     * @return string|self
     */
    public function action($action = null)
    {
        if(null === $action)
        {
            return $this->_action;
        }
        if(in_array(trim($action), self::$_validActions))
        {
            $this->_action = trim($action);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid action');
        }
        return $this;
    }

    /**
     * Gets or sets content
     *
     * @param  Attachment $content
     * @return Attachment|self
     */
    public function content(Attachment $content = null)
    {
        if(null === $content)
        {
            return $this->_content;
        }
        $this->_content = $content;
        return $this;
    }

    /**
     * Gets or sets flush
     *
     * @param  bool $flush
     * @return bool|self
     */
    public function flush($flush = null)
    {
        if(null === $flush)
        {
            return $this->_flush;
        }
        $this->_flush = (bool) $flush;
        return $this;
    }

    /**
     * Gets or sets synchronous
     *
     * @param  bool $synchronous
     * @return bool|self
     */
    public function synchronous($synchronous = null)
    {
        if(null === $synchronous)
        {
            return $this->_synchronous;
        }
        $this->_synchronous = (bool) $synchronous;
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
            'action' => $this->_action,
        );
        if($this->_content instanceof Attachment)
        {
            $this->array += $this->_content->toArray('content');
        }
        if(is_bool($this->_flush))
        {
            $this->array['flush'] = $this->_flush ? 1 : 0;
        }
        if(is_bool($this->_synchronous))
        {
            $this->array['synchronous'] = $this->_synchronous ? 1 : 0;
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
        $this->xml->addAttribute('action', $this->_action);
        if($this->_content instanceof Attachment)
        {
            $this->xml->append($this->_content->toXml('content'));
        }
        if(is_bool($this->_flush))
        {
            $this->xml->addAttribute('flush', $this->_flush ? 1 : 0);
        }
        if(is_bool($this->_synchronous))
        {
            $this->xml->addAttribute('synchronous', $this->_synchronous ? 1 : 0);
        }
        return parent::toXml();
    }
}
