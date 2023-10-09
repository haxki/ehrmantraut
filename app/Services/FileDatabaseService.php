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
            $row = $this->compact($rowValues);
            $file = fopen("storage/{$this->filename}", $writingMode);
            fwrite($file, $row);
            fclose($file);    
        }
        protected function compact(array $rowValues) : string {
            $row = "";
            foreach ($this->columnOrder as $column) {
                $row .= "'" . $rowValues[$column] . "';";
            }
            $row = substr($row, 0, strlen($row) - 1) . "\n";

            return $row;
        }

        public function extractAll() : array {
            $rows = [];
            $file = fopen("storage/{$this->filename}", 'r');
            while ($row = fgets($file)) {
                $row = substr($row, 1, strlen($row) - 4);   // 4 - "'\r\n"
                $rowValues = explode("';'", $row);
                $rowValuesWithKeys = [];
                for ($i = 0; $i < count($this->columnOrder); $i++) {
                    $rowValuesWithKeys[$this->columnOrder[$i]] = $rowValues[$i];
                }
                array_push($rows, $rowValuesWithKeys);
            }
            fclose($file);
            return $rows;
        }
    }