<?php
declare(strict_types=1);

namespace App\Feed\MakeFile;

final class MakeCSV extends AbstractMakeFile
{
    protected string $path = __DIR__;

    protected string $file = '/file.csv';

    public function make(): string
    {
        $data = $this->getData();
        $file = '';

        if ($data !== []) {
            $file = $this->path . $this->file;

            $fp = \fopen($file, 'wb');

            \fputcsv($fp, array_keys($data[0]));

            foreach ($data as $fields) {
                \fputcsv($fp, $fields, ',');
            }

            \fclose($fp);
        }

        return $file;
    }
}