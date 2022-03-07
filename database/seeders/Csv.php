<?php

namespace Database\Seeders;

use Illuminate\Contracts\Filesystem\FileNotFoundException;

class Csv
{
    protected string $file;

    public function __construct()
    {
    }

    public function setFile(string $file): void
    {
        $this->file = base_path("database/seeders/data/{$file}");
    }

    public function read(): array
    {
        $filehandle = fopen($this->file, "r", false);

        if (!$filehandle) {
            throw new FileNotFoundException("unable to open {$this->file}");
        }

        $buffer = [];

        while (($data = fgetcsv($filehandle, 1000, ",")) !== false) {
            $buffer[] = $data;
        }

        fclose($filehandle);
        array_shift($buffer); // removed headers

        return $buffer;
    }
}
