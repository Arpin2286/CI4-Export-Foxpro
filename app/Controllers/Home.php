<?php

namespace App\Controllers;

use App\Models\UtilityModel;
use Config\Services;
use XBase\TableReader;

// Set your php.ini
ini_set('max_file_uploads', 50);
ini_set('upload_max_filesize', '10M');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '999999999M');
class Home extends BaseController
{
    public function index(): string
    {
        return view('index');
    }

    public function upload()
    {
        try {
            $data = $this->request->getFileMultiple('file_upload');

            foreach ($data as $key => $row) {
                $tableData = [];
                $field = [];
                $table = new TableReader($row->getTempName());
                $columns = $table->getColumns();

                $jml_record = $table->getRecordCount();

                foreach ($columns as $column) {
                    $tableData[strtolower($column->getName())] = $column->getType();
                    $field[strtolower($column->getName())] = [
                        'type' => self::getType($column->getType()), //'VARCHAR',
                        'constraint' => in_array($column->getType(), ['C', 'M']) ? 100 : '',
                        'null' => true,
                    ];
                }

                $tableData['table_name'] = str_replace('.dbf', '', strtolower($row->getName()));
                $tableData['field'] = $field;

                $record = [];
                for ($i = 0; $i < $jml_record; $i++) {
                    $record[] = $table->pickRecord($i)->getData();
                }
                $insertData = $record;

                $execute = (new UtilityModel())->uploadFile($tableData, $insertData);

                if ($execute) {
                    log_message('info', 'Table ' . $tableData['table_name'] . ' OK');
                } else {
                    log_message('error', 'Some Problem On' . $tableData['table_name']);
                }
            }
            return redirect()->back()->with('success', 'Cek Database');
        } catch (\Throwable $th) {
            \log_message('error', __METHOD__ . '|' . $th->getMessage() . '|' . $th->getFile() . '|' . $th->getLine());
            return redirect()->back()->with('error', 'Sistem Mengalami Masalah. 500');
        }
    }

    private function getType($value)
    {
        $result = '';
        switch ($value) {
            case 'C':
                $result = 'VARCHAR';
                break;
            case 'N':
            case 'I':
            case 'F':
                $result = 'DECIMAL(12,2)';
                break;
            case 'L':
                $result = 'BOOLEAN';
                break;
            case 'D':
                $result = 'DATE';
                break;
            case 'T':
                $result = 'DATETIME';
                break;
            case 'B':
                $result = 'DOUBLE';
                break;
            default:
                $result = 'VARCHAR';
                break;
        }
        return $result;
    }
}
