<?php

declare(strict_types=1);

namespace DSKZPT\Personio\Client;

use Psr\Http\Message\RequestFactoryInterface;
use SimpleXMLElement;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class PersonioApiClient
{
    private RequestFactory $requestFactory;

    public function __construct()
    {
        /** @var RequestFactory $requestFactory */
        $requestFactory = GeneralUtility::makeInstance(RequestFactoryInterface::class);
        $this->requestFactory = $requestFactory;
    }

    /**
     * @return mixed[]
     */
    public function fetchFeedItems(string $feedUrl): array
    {
        $additionalOptions = [
            'headers' => ['Cache-Control' => 'no-cache'],
            'allow_redirects' => false,
        ];

        $response = $this->requestFactory->request($feedUrl, 'GET', $additionalOptions);

        if ($response->getStatusCode() === 200
            && str_starts_with($response->getHeaderLine('Content-Type'), 'text/xml')) {
            $content = $response->getBody()->getContents();

            $contentString = simplexml_load_string($content, SimpleXMLElement::class, LIBXML_NOCDATA);

            $return = json_decode(
                (string)json_encode($contentString),
                true
            )['position'];

            return isset($return[0]) ? $return : [$return];
        }

        return [];
    }
}
