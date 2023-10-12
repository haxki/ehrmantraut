<?php
    namespace App\Services;

    class FileDatabaseService {
        protected string $filename;
        protected array $columnOrder;
        public function __construct(string $filename, array $columnOrder) {
            $this->filename = $filename;
            $this->columnOrder = $columnOrder;
        }

        public function append(array $rowValues) { 
            $this->writeRow($rowValues, 'a');
        }
        protected function writeRow(array $rowValues, string $writingMode) {
            $file = fopen("storage/{$this->filename}", $writingMode);
            $orderedRowValues = [];
            foreach ($this->columnOrder as $column) {
                $orderedRowValues[$column] = $rowValues[$column];
            }
            fputcsv($file, $orderedRowValues, ';', '\'');
            fclose($file);
        }
        public function extractAll() : array {
            $rows = [];
            $file = fopen("storage/{$this->filename}", 'r');
            while ($row = fgetcsv($file, null, ';', '\'')) {
                for ($i = 0; $i < count($this->columnOrder); $i++) {
                    $rowValuesWithKeys[$this->columnOrder[$i]] = $row[$i];
                }
                array_push($rows, $rowValuesWithKeys);
            }
            fclose($file);
            return $rows;
        }
    }