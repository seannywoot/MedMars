<?php

$connect = new PDO("mysql:host=localhost;dbname=patient_list", "root", "");

if (isset($_POST["action"])) {
    if ($_POST["action"] == 'fetch') {
        $departments = [
            'CAHS' => 'cahs_list',
            'CHTM' => 'chtm_list',
            'CBA'  => 'cba_list',
            'CEAS' => 'ceas_list',
            'CCS'  => 'patient'
        ];

        $data = [];
        foreach ($departments as $name => $table) {
            $query = "SELECT COUNT(*) AS total FROM $table";
            $statement = $connect->query($query);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            $data[] = [
                'department' => $name,
                'total'      => $result['total']
            ];
        }

        echo json_encode($data); // Return all department data as JSON
    }
}
?>