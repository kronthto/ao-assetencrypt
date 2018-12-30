<?php

namespace Kronthto\AOEncrypt;

use Kronthto\AOArchive\Archive;

class XorFile
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
        $encrypted = clone $archive;

        foreach ($encrypted->entries as $key => $entry) {
            $encryptedEntry = clone $entry;
            $encryptedEntry->content = $xorer->doXor($entry->content);
            $encrypted->entries[$key] = $encryptedEntry;
        }

        return $encrypted;
    }
}
