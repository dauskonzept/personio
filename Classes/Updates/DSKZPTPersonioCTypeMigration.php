<?php

declare(strict_types=1);

namespace DSKZPT\Personio\Updates;

use TYPO3\CMS\Core\Attribute\UpgradeWizard;
use TYPO3\CMS\Core\Upgrades\AbstractListTypeToCTypeUpdate;

#[UpgradeWizard('dskzptPersonioCTypeMigration')]
final class DSKZPTPersonioCTypeMigration extends AbstractListTypeToCTypeUpdate
{
    public function getTitle(): string
    {
        return 'Migrate "Personio" plugins to content elements.';
    }

    public function getDescription(): string
    {
        return 'The "Personio" plugins are now registered as content element. Update migrates existing records and backend user permissions.';
    }

    /**
     * This must return an array containing the "list_type" to "CType" mapping
     *
     * @return array<string, string>
     */
    protected function getListTypeToCTypeMapping(): array
    {
        return [
            'personio_list' => 'personio_list',
            'personio_show' => 'personio_show',
        ];
    }
}
