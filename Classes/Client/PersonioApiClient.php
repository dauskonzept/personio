<?php

declare(strict_types=1);

namespace DSKZPT\Personio\Client;

use Psr\Http\Message\RequestFactoryInterface;
use SimpleXMLElement;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class PersonioApiClient
{
    private RequestFactoryInterface $requestFactory;

    public function __construct() {
        $this->requestFactory = GeneralUtility::makeInstance(RequestFactoryInterface::class);
    }

    /**
     * @return mixed[]
     */
    public function fetchFeedItems(string $feedUrl): array
    {
        $additionalOptions = [
            'headers' => ['Cache-Control' => 'no-cache'],
            'allow_redirects' => false
        ];

        $response = $this->requestFactory->request($feedUrl, 'GET', $additionalOptions);

        if ($response->getStatusCode() === 200
            && strpos($response->getHeaderLine('Content-Type'), 'text/xml') === 0) {
            $content = $response->getBody()->getContents();

            return json_decode(
                json_encode(
                    simplexml_load_string($content, SimpleXMLElement::class, LIBXML_NOCDATA)
                ), true
            )['position'];
        }

        return [];
    }
}
