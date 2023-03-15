<?php
/**
 * ItemsApi
 * PHP version 5
 *
 * @category Class
 * @package  Meli
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * MELI Markeplace SDK
 *
 * This is a the codebase to generate a SDK for Open Platform Marketplace
 *
 * The version of the OpenAPI document: 3.0.0
 * 
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 4.3.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Meli\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Query;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Utils;
use Meli\ApiException;
use Meli\Configuration;
use Meli\HeaderSelector;
use Meli\ObjectSerializer;

/**
 * ItemsApi Class Doc Comment
 *
 * @category Class
 * @package  Meli
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ItemsApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $host_index (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $host_index = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $host_index;
    }

    /**
     * Set the host index
     *
     * @param  int Host index (required)
     */
    public function setHostIndex($host_index)
    {
        $this->hostIndex = $host_index;
    }

    /**
     * Get the host index
     *
     * @return Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation itemsIdGet
     *
     * Return a Item.
     *
     * @param  string $id id (required)
     *
     * @throws \Meli\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function itemsIdGet($id)
    {
        list($response) = $this->itemsIdGetWithHttpInfo($id);
        return $response;
    }

    /**
     * Operation itemsIdGetWithHttpInfo
     *
     * Return a Item.
     *
     * @param  string $id (required)
     *
     * @throws \Meli\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function itemsIdGetWithHttpInfo($id)
    {
        $request = $this->itemsIdGetRequest($id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation itemsIdGetAsync
     *
     * Return a Item.
     *
     * @param  string $id (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function itemsIdGetAsync($id)
    {
        return $this->itemsIdGetAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation itemsIdGetAsyncWithHttpInfo
     *
     * Return a Item.
     *
     * @param  string $id (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function itemsIdGetAsyncWithHttpInfo($id)
    {
        $returnType = 'object';
        $request = $this->itemsIdGetRequest($id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'itemsIdGet'
     *
     * @param  string $id (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function itemsIdGetRequest($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling itemsIdGet'
            );
        }

        $resourcePath = '/items/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = Utils::jsonEncode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation itemsIdPut
     *
     * Update a Item.
     *
     * @param  string $id id (required)
     * @param  string $access_token access_token (required)
     * @param  \Meli\Model\Item $item item (required)
     *
     * @throws \Meli\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function itemsIdPut($id, $access_token, $item)
    {
        list($response) = $this->itemsIdPutWithHttpInfo($id, $access_token, $item);
        return $response;
    }

    /**
     * Operation itemsIdPutWithHttpInfo
     *
     * Update a Item.
     *
     * @param  string $id (required)
     * @param  string $access_token (required)
     * @param  \Meli\Model\Item $item (required)
     *
     * @throws \Meli\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function itemsIdPutWithHttpInfo($id, $access_token, $item)
    {
        $request = $this->itemsIdPutRequest($id, $access_token, $item);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation itemsIdPutAsync
     *
     * Update a Item.
     *
     * @param  string $id (required)
     * @param  string $access_token (required)
     * @param  \Meli\Model\Item $item (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function itemsIdPutAsync($id, $access_token, $item)
    {
        return $this->itemsIdPutAsyncWithHttpInfo($id, $access_token, $item)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation itemsIdPutAsyncWithHttpInfo
     *
     * Update a Item.
     *
     * @param  string $id (required)
     * @param  string $access_token (required)
     * @param  \Meli\Model\Item $item (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function itemsIdPutAsyncWithHttpInfo($id, $access_token, $item)
    {
        $returnType = 'object';
        $request = $this->itemsIdPutRequest($id, $access_token, $item);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'itemsIdPut'
     *
     * @param  string $id (required)
     * @param  string $access_token (required)
     * @param  \Meli\Model\Item $item (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function itemsIdPutRequest($id, $access_token, $item)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling itemsIdPut'
            );
        }
        // verify the required parameter 'access_token' is set
        if ($access_token === null || (is_array($access_token) && count($access_token) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $access_token when calling itemsIdPut'
            );
        }
        // verify the required parameter 'item' is set
        if ($item === null || (is_array($item) && count($item) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $item when calling itemsIdPut'
            );
        }

        $resourcePath = '/items/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($access_token !== null) {
            if('form' === 'form' && is_array($access_token)) {
                foreach($access_token as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['access_token'] = $access_token;
            }
        }


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($item)) {
            $_tempBody = $item;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = Utils::jsonEncode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation itemsPost
     *
     * Create a Item.
     *
     * @param  string $access_token access_token (required)
     * @param  \Meli\Model\Item $item item (required)
     *
     * @throws \Meli\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object
     */
    public function itemsPost($access_token, $item)
    {
        list($response) = $this->itemsPostWithHttpInfo($access_token, $item);
        return $response;
    }

    /**
     * Operation itemsPostWithHttpInfo
     *
     * Create a Item.
     *
     * @param  string $access_token (required)
     * @param  \Meli\Model\Item $item (required)
     *
     * @throws \Meli\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object, HTTP status code, HTTP response headers (array of strings)
     */
    public function itemsPostWithHttpInfo($access_token, $item)
    {
        $request = $this->itemsPostRequest($access_token, $item);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    if ('object' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = (string) $responseBody;
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation itemsPostAsync
     *
     * Create a Item.
     *
     * @param  string $access_token (required)
     * @param  \Meli\Model\Item $item (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function itemsPostAsync($access_token, $item)
    {
        return $this->itemsPostAsyncWithHttpInfo($access_token, $item)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation itemsPostAsyncWithHttpInfo
     *
     * Create a Item.
     *
     * @param  string $access_token (required)
     * @param  \Meli\Model\Item $item (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function itemsPostAsyncWithHttpInfo($access_token, $item)
    {
        $returnType = 'object';
        $request = $this->itemsPostRequest($access_token, $item);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = (string) $responseBody;
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'itemsPost'
     *
     * @param  string $access_token (required)
     * @param  \Meli\Model\Item $item (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function itemsPostRequest($access_token, $item)
    {
        // verify the required parameter 'access_token' is set
        if ($access_token === null || (is_array($access_token) && count($access_token) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $access_token when calling itemsPost'
            );
        }
        // verify the required parameter 'item' is set
        if ($item === null || (is_array($item) && count($item) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $item when calling itemsPost'
            );
        }

        $resourcePath = '/items';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($access_token !== null) {
            if('form' === 'form' && is_array($access_token)) {
                foreach($access_token as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['access_token'] = $access_token;
            }
        }



        // body params
        $_tempBody = null;
        if (isset($item)) {
            $_tempBody = $item;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = Utils::jsonEncode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
