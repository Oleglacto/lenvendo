<?php

namespace App\Reports;

use App\Contracts\ReportFileInterface;
use Box\Spout\Common\Entity\Cell;
use Box\Spout\Common\Entity\Row;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Common\Creator\WriterFactory;
use Box\Spout\Writer\WriterInterface;

class XlsxReport implements ReportFileInterface
{
    private WriterInterface $writer;

    private string $fileName;

    public function openFile()
    {
        $this->fileName = now()->timestamp . '.xlsx';
        $pathToFile = storage_path('app/public/'. $this->fileName);
        $this->writer = WriterFactory::createFromType(Type::XLSX);
        $this->writer->openToFile($pathToFile);
    }

    public function addRow(array $row): void
    {
        $sells = [];
        foreach ($row as $item) {
            $sells[] = new Cell($item);
        }

        $this->writer->addRow(new Row($sells, null));
    }

    public function closeFile(): string
    {
        $this->writer->close();
        return '/storage/' . $this->fileName;
    }
}
