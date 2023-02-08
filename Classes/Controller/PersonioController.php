<?php

declare(strict_types=1);

namespace DSKZPT\Personio\Controller;

use DSKZPT\Personio\Client\PersonioApiClient;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class PersonioController extends ActionController
{
    private string $feedUrl = '';

    public function __construct(
        private PersonioApiClient $personioApiClient,
    ) {
    }

    protected function initializeAction(): void
    {
        $this->buildSettings();
        $this->feedUrl = sprintf('%s?language=%s', $this->settings['feedUrl'], $this->settings['language']);
    }

    public function listAction(): ResponseInterface
    {
        foreach ($this->settings['filter'] as $filterKey => $filterValue) {
            if (is_null($filterValue) || $filterValue == '') {
                unset($this->settings['filter'][$filterKey]);
            }
        }

        $items = $this->personioApiClient->fetchFeedItems($this->feedUrl);

        if (!empty($this->settings['filter'])) {
            $items = array_filter($items, [$this, 'filterItems'], ARRAY_FILTER_USE_BOTH);
        }

        $this->view->assign('items', $items);

        return $this->htmlResponse();
    }

    public function showAction(): ResponseInterface
    {
        $uid = $this->request->getArgument('uid');

        $items = $this->personioApiClient->fetchFeedItems($this->feedUrl);
        $item = $items[array_search($uid, array_column($items, 'id'))];

        $this->view->assignMultiple([
            'item' => $item,
            'feedUrl' => parse_url($this->feedUrl),
        ]);

        $GLOBALS['TSFE']->page['title'] = $item['name'];

        return $this->htmlResponse();
    }

    private function buildSettings(): void
    {
        if (is_array($this->settings['overwrite'])) {
            foreach ($this->settings['overwrite'] as $key => $value) {
                if (!empty($value)) {
                    $this->settings[$key] = trim($value);
                }
            }
        }

        unset($this->settings['overwrite']);
    }

    /**
     * @param array<string, mixed> $value
     */
    private function filterItems(array $value): bool
    {
        foreach ($this->settings['filter'] as $filterKey => $filterValue) {
            if (!array_key_exists($filterKey, $value) || $value[$filterKey] !== $filterValue) {
                return false;
            }
        }

        return true;
    }
}
