<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Upload;

use Evenement\EventEmitter;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Response as HttpResponse;

/**
 * Upload request class in Zimbra API PHP.
 * 
 * @package   Zimbra
 * @category  Upload
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Client extends EventEmitter
{

    /**
     * Upload service location
     * @var string
     */
    private $_location;

    /**
     * authentication token
     * @var string
     */
    private $_authToken;

    /**
     * Http client
     * @var HttpClient
     */
    private $_httpClient;

    /**
     * Http response
     * @var HttpResponse
     */
    private $_httpResponse;

    /**
     * Http headers
     * @var array
     */
    private $_headers = [];

    /**
     * Base constructor
     *
     * @param string $location  The URL to request.
     * @param string $authToken The authentication token
     */
    public function __construct($location, $authToken = null)
    {
        $this->_location = $location;
        $this->_httpClient = new HttpClient([
            'cookies' => true,
            'verify' => false,
        ]);
        $this->_headers = [
            'Method'     => 'POST',
            'User-Agent' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'PHP-Zimbra-Soap-API',
        ];
        if(null !== $authToken)
        {
            $this->_authToken = trim($authToken);
        }
    }

    /**
     * Performs a upload request
     *
     * @param  Request $request
     * @return An array attactment objects
     */
    public function upload(Request $request)
    {
        $this->emit('before.request', [$request, &$this->headers]);
        $files = $request->getFiles();
        if ($files->count() == 0) {
            throw new \UnexpectedValueException(
                "Upload request must have at least one file."
            );
        }

        $options = [
            'query' => ['fmt' => 'raw,extended'],
            'headers' => $this->headers,
            'multipart' => [
                ['name' => 'requestId', 'contents' => $request->getRequestId()]
            ],
        ];
        foreach ($files as $file)
        {
            $options['multipart'][] = ['name' => basename($file), 'contents' => fopen($file, 'r')];
        }
        if (!empty($this->_authToken))
        {
            $options['cookies'] = CookieJar::fromArray(['ZM_AUTH_TOKEN' => $this->_authToken], null);
        }

        try
        {
            $this->_httpResponse = $this->_httpClient->request('POST', $this->_location, $options);
            $this->emit('after.request', [$this->_httpResponse, $this->_httpResponse->getHeaders()]);
        }
        catch (BadResponseException $ex)
        {
            if ($ex->hasResponse())
            {
                $this->_httpResponse = $ex->getResponse();
                $this->emit('after.request', [$this->_httpResponse, $this->_httpResponse->getHeaders()]);
            }
            throw $ex;
        }
        return $this->_parseResponse($this->_httpResponse);
    }

    /**
     * Gets headers
     *
     * @return string
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Check if a specific header exists on the POST file by name.
     *
     * @param string $name Case-insensitive header to check
     *
     * @return bool
     */
    public function hasHeader($name)
    {
        return isset(array_change_key_case($this->headers)[strtolower($name)]);
    }

    /**
     * Gets upload service location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->_location;
    }

    /**
     * Sets upload service location
     *
     * @param  string $location
     * @return self
     */
    public function setLocation($location)
    {
        $this->_location = trim($location);
        return $this;
    }

    /**
     * Gets authentication token
     *
     * @return string
     */
    public function getAuthToken()
    {
        return $this->_authToken;
    }

    /**
     * Sets authentication token
     *
     * @param  string $filePath
     * @return self
     */
    public function setAuthToken($authToken)
    {
        $this->_authToken = trim($authToken);
        return $this;
    }

    /**
     * Gets http client
     *
     * @return HttpClient
     */
    public function getHttpClient()
    {
        return $this->_httpClient;
    }

    /**
     * Sets http client
     *
     * @param  HttpClient $httpClient
     * @return self
     */
    public function setHttpClient(HttpClient $httpClient)
    {
        $this->_httpClient = $httpClient;
        return $this;
    }

    /**
     * Returns last response.
     *
     * @return mix The last response.
     */
    public function lastResponse()
    {
        if($this->_httpResponse instanceof HttpResponse)
        {
            return $this->_httpResponse->getBody();
        }
        return null;
    }

    /**
     * Returns the headers from the last response.
     *
     * @return mix The last response headers.
     */
    public function lastResponseHeaders()
    {
        if($this->_httpResponse instanceof HttpResponse)
        {
            return $this->_httpResponse->getHeaders();                
        }
        return [];
    }

    private function _parseResponse(HttpResponse $httpResponse)
    {
        $attactments = [];
        $body = $httpResponse->getBody();
        preg_match('/\[\{(.*)\}\]/', $body, $matches, PREG_OFFSET_CAPTURE, 3);
        $match = !empty($matches[0][0]) ? $matches[0][0] : false;
        if (!empty($match))
        {
            $data = json_decode($match);
            if (is_array($data))
            {
                foreach ($data as $object)
                {
                    $attachmentId = !empty($object->aid) ? $object->aid : '';
                    $fileName = !empty($object->filename) ? $object->filename : '';
                    $contentType = !empty($object->ct) ? $object->ct : '';
                    $attactments[] = new Attactment($attachmentId, $fileName, $contentType);
                }
            }
            else
            {
                $attachmentId = !empty($data->aid) ? $data->aid : '';
                $fileName = !empty($data->filename) ? $data->filename : '';
                $contentType = !empty($data->ct) ? $data->ct : '';
                $attactments[] = new Attactment($attachmentId, $fileName, $contentType);
            }
        }
        return $attactments;
    }
}
