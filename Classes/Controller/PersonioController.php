<?php

namespace DSKZPT\Personio\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use DSKZPT\Personio\Service\PersonioService;

class PersonioController extends ActionController
{
    private string $feedUrl = '';

    protected ?PersonioService $personioService = null;

    protected function initializeAction(): void
    {
        $this->buildSettings();
        $this->personioService = GeneralUtility::makeInstance(PersonioService::class);
        $this->feedUrl = sprintf('%s?language=%s', $this->settings['feedUrl'], $this->settings['language']);
    }

    public function listAction(): void
    {
        foreach ($this->settings['filter'] as $filterKey => $filterValue) {
            if (is_null($filterValue) || $filterValue == '') {
                unset($this->settings['filter'][$filterKey]);
            }
        }

        $items = $this->personioService->fetchFeedItems($this->feedUrl);

        if (!empty($this->settings['filter'])) {
            $items = array_filter($items, array($this, 'filterItems'), ARRAY_FILTER_USE_BOTH);
        }

        $this->view->assign('items', $items);
    }

    public function showAction(): void
    {
        if (!$this->request->hasArgument('uid')
            && intval($this->request->getArgument('uid'))
        ) {
            return;
        }

        $uid = $this->request->getArgument('uid');

        $items = $this->personioService->fetchFeedItems($this->feedUrl);
        $item = $items[array_search($uid, array_column($items, 'id'))];

        $this->view->assignMultiple([
            'item' => $item,
            'feedUrl' => parse_url($this->feedUrl),
        ]);

        $GLOBALS['TSFE']->page['title'] = $item['name'];
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
