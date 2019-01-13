<?php

namespace Kronthto\AOEncrypt;

use Kronthto\AOArchive\Archive\Archive;
use Kronthto\AOArchive\Archive\ArchiveEntry;

class XorArchive
{
    // Main Routine
    public function transform(string $archiveData, HexXorer $xorer): string
    {
        $archive = $this->readArchive($archiveData);
        $encryptedArchive = $this->encryptArchiveEntries($archive, $xorer);

        return $encryptedArchive->pack();
    }

    public function readArchive(string $archiveData): Archive
    {
        return new Archive($archiveData, true);
    }

    public function encryptArchiveEntries(Archive $archive, HexXorer $xorer): Archive
    {
        return $archive->map(function (ArchiveEntry $entry) use ($xorer): ArchiveEntry {
            $entry->content = $xorer->doXor($entry->content);

            return $entry;
        });
    }
}
