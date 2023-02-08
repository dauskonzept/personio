<?php

namespace DSKZPT\Personio\Hook;

use DSKZPT\Personio\Service\PersonioService;

class ItemsProcFunc
{
    /**
     * @param mixed[] $params
     */
    public function getFilterValues(array &$params): void
    {
        $params['items'] = [
            ['None', '']
        ];

        $feedUrl = $params['flexParentDatabaseRow']['pi_flexform']['data']['sDEF']['lDEF']['settings.overwrite.feedUrl']['vDEF'];

        if (empty($feedUrl)) {
            return;
        }

        $personioService = new PersonioService();
        $items = $personioService->fetchFeedItems($feedUrl);

        $explode = explode('.', $params['field']);

        $filterKey = end($explode);
        $filter = [];

        foreach ($items as $item) {
            if (array_key_exists($filterKey, $item)) {
                $filter[] = $item[$filterKey];
            }
        }

        $filter = array_unique($filter);

        foreach ($filter as $filterValue) {
            $params['items'][] = [$filterValue, $filterValue];
        }
    }
}
