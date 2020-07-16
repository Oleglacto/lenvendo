<?php

namespace App\Contracts;

interface ReportFileInterface
{
    public function openFile();

    public function addRow(array $row): void;

    /**
     * Вернет путь до файла
     *
     * @return string
     */
    public function closeFile(): string;
}
