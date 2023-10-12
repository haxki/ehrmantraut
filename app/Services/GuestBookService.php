<?php
    namespace App\Services;
    class GuestBookService extends FileDatabaseService {
        public function __construct() {
            $this->columnOrder = ['date', 'fio', 'email', 'message'];
            $this->filename = 'messages.inc';
        }

        public function serve(array $newRow = null) {
            $rows = $this->extractAll();
            $dates = $this->restructDates($rows);
            array_multisort($dates, SORT_DESC, $rows);
            
            if ($newRow != null){
                $this->restructNewRow($newRow);
                $this->append($newRow);
                array_unshift($rows, $newRow);
            }
            return $rows; 
        }

        /** make 2019.01.31 from 31.01.2019 */
        private function restructDates(array &$rows) {
            $dates = [];
            foreach ($rows as $row) {
                $dateParts = explode('.', $row['date']);
                $dates[] = $dateParts[2] . '.' . $dateParts[1] . '.' . $dateParts[0];
            }
            return $dates;
        }

        /** make array that matches columnOrder */
        private function restructNewRow(array &$data) {
            $data['fio'] = $data['lastname'] . ' ' . $data['firstname']
                . ($data['patronymic'] != null ? ' ' . $data['patronymic'] : '');
            unset($data['lastname'], $data['firstname'], $data['patronymic']);
            $data['date'] = date('d.m.Y');
        }

        public function extractAllWithImages() : array {
            $rows = [];
            $file = fopen("storage/{$this->filename}", 'r');
            
            while ($row = fgets($file)) {
                if (strstr($row, "#START_IMAGE_VALUES#") != false) {
                    break;
                }
                $row = substr($row, 1, strlen($row) - 4);   // 4 - "'\r\n"
                $rowValues = explode("';'", $row);
                $rowValuesWithKeys = [];
                for ($i = 0; $i < count($this->columnOrder); $i++) {
                    $rowValuesWithKeys[$this->columnOrder[$i]] = $rowValues[$i];
                }
                array_push($rows, $rowValuesWithKeys);
            }

            $image = "";
            while($row = fgets($file)) {

            }

            fclose($file);
            return $rows;
    }
}