<?php
// header("Content-Type: application/json");
// require_once 'connect.php';

//     if (isset($_POST['table'])) {
//         if ($_POST['table'] === 'historique') {
//             $obj = new connect();
//             $patients = $obj->select('historique');
//             $Datatable = [];
//             foreach ($patients as $p) {
//                 $CIN = $p->CIN ;
//                 $count = 0 ;
//                 if ( $count == 0 ) {
//                     $patient = array (
//                     'CIN' => $p->CIN ,
//                     'firstAndLastName' => $p->First_Name .' '.$p->Last_Name ,
//                     );
//                     array_push($Datatable,$patient);
//                 }
//                 elseif($p->CIN == $CIN && $count != 0 ){
//                     continue ;
//                 }else {
//                     $patient = array (
//                         'CIN' => $p->CIN ,
//                         'firstAndLastName' => $p->First_Name .' '.$p->Last_Name ,
//                         );
//                     array_push($Datatable,$patient);
//                 }
//                 $count++;
//             }
            
//         }

//         echo json_encode(['history' => $Datatable]);;
//     }
?>