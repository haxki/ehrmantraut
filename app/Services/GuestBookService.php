<?php
    namespace App\Services;

use Illuminate\Support\Facades\Storage;

    class GuestBookService extends FileDatabaseService {
        public function __construct() {
            $this->columnOrder = ['date', 'fio', 'email', 'message', 'image'];
            $this->filename = 'messages.inc';
        }

        public function serve(array $newRow = null) : array {
            $rows = $this->extractAll();
            $dates = $this->sortableDates($rows);
            array_multisort($dates, SORT_DESC, $rows);
            
            if ($newRow != null) {
                $this->restructNewRow($newRow);
                if (isset($newRow['image'])) {
                    $filename = $newRow['image']->hashName();
                    Storage::putFileAs('/public/img', $newRow['image'], $filename);
                    $file_path = public_path('storage/img/') . $filename;
                    $newRow['image'] = 'data:image/' . pathinfo($file_path, PATHINFO_EXTENSION) . ';base64,';
                    
                    $newRow['image'] .= base64_encode(file_get_contents($file_path));
                    
                    Storage::delete('/public/img/' . $filename);
                } else {
                    $newRow['image'] = '';
                }

                $this->append($newRow);
                array_unshift($rows, $newRow);
            }
            return $rows; 
        }

        /** make 2019.01.31 from 31.01.2019 */
        private function sortableDates(array &$rows) : array {
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

}