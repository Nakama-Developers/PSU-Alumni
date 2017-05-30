<?php
require "printdata.php";
session_start();
if(isset($_SESSION['role'])){
    if($_SESSION['role'] == "admin"){

        function filter(){
        // This is how the session filter array looks like:
        //$_SESSION['filters'] = array('GPA' => ['2.0', '3.0']), 'Nationality' => ['saudi'], 'Company_size' => ['large'], 'Major' => ['Computer Science', 'Marketing', 'Finance']);
        if($_GET['checked'] == "true"){
                if(!isset($_SESSION['filters'])){
                    $_SESSION['filters'] = array();
                }
                if(isset($_SESSION['filters'][$_GET['category']])){
                    array_push($_SESSION['filters'][$_GET['category']], $_GET['value']);
                } else{
                    $_SESSION['filters'][$_GET['category']] = array();
                    array_push($_SESSION['filters'][$_GET['category']], $_GET['value']);
                }
                // echo extractQuery();
                echo json_encode(printRecords(1));
            }else{
                if(isset($_SESSION['filters'][$_GET['category']])){
                    unset($_SESSION['filters'][$_GET['category']][array_search($_GET['value'],$_SESSION['filters'][$_GET['category']])]);
                    $_SESSION['filters'][$_GET['category']] = removeGaps($_SESSION['filters'][$_GET['category']]);
                    if(count($_SESSION['filters'][$_GET['category']]) === 0){
                        unset($_SESSION['filters'][$_GET['category']]);
                        if(count($_SESSION['filters']) === 0){
                            unset($_SESSION['filters']);
                        }
                    }
                }
                // echo extractQuery();
                echo json_encode(printRecords(1));
            }
        }

        function sortRecords(){
            $_SESSION['sort'] = $_GET['sort-method'];
            echo json_encode(printRecords(1));
        }

        function navPages(){
            if(isset($_GET['pageNum'])){
                $output = array('records' => printRecords($_GET['pageNum']), 'pinnedRecords' => $_SESSION['pinStateChange']);
                if($_SESSION['pinStateChange'] == 1){
                    $output = array('records' => printRecords($_GET['pageNum']), 'pinnedRecords' => printPinnedRecords());
                    $_SESSION['pinStateChange'] = NULL;
                }
                echo json_encode($output);
            }
        }

        function pin($id){
            if(!isset($_SESSION['pinned'])){
                $_SESSION['pinned'] = array();
            }
            array_push($_SESSION['pinned'], $id);
            $_SESSION['pinStateChange'] = 1;
            $array = array("recieved" => 1, "type" => "pin", "query" => pinToQuery());
            echo json_encode($array);
        }

        function unpin($id){
            if(isset($_SESSION['pinned'])){
                unset($_SESSION['pinned'][array_search($id, $_SESSION['pinned'])]);
                $_SESSION['pinned'] = removeGaps($_SESSION['pinned']);
                if(count($_SESSION['pinned']) == 0){
                    unset($_SESSION['pinned']);
                }
                $_SESSION['pinStateChange'] = 1;
            }
            $array = array("recieved" => 1, "type" => "unpin", "query" => pinToQuery());
            echo json_encode($array);
        }

        function setFeild($num, $value){
            if(isset($_SESSION['headers'])){
                $_SESSION['headers'][$num] = $value;
                $_SESSION['pinStateChange'] = 1;
            }
        }

        function search($value, $type){
            $_SESSION['search'] = array($type, $value);
            // echo json_encode(printRecords(1));
        }

        function invite($id){
            $address = isInvited('212210282');
            if($address == NULL){
                echo "Already invited";
            }
            else {
                $hash = createHash($id);
                $subject = "PSU - Alumni Portal";
                $content = <<<_HTML_
                <!DOCTYPE html>
                <html lang="en">
                    <head>
                      <title>Login page</title>
                      <meta name="viewport" content="width=device-width, initial-scale=1.0">
                      <meta charset="utf-8">
                      <style>
			    * {
			    box-sizing: border-box;
			    font-family: Arial;
			    }
			
			    body{
			    margin: 0;
			    font-size: 0.8em;
			    }

			    header{
			    height: 60px;
			    background-color: #FFF;
			    /*background-color: #14406E;*/
			    background-clip: border-box;
			    }
	
			    header > img{
			    max-height: 100%;
			    display: block;
			    }

			    .sign-up{
			    display: inline-block;
			    font-size: 20px;
			    font-weight: bold;
			    color: #FFF;
			    background-color: #FDC504;
			    border: 1px solid rgba(0,0,0, 0.1);
			    padding: 10px 25px;
			    font-weight: bold;
			    text-decoration: none;
			    transition: opacity 0.5s, box-shadow 0.3s;
			    border-radius: 5px;
			    }

			    .sign-up:hover{
			    transition: opacity 0.5s, box-shadow 0.3s;
			    opacity: 0.8;
			    }
			    .sign-up:active{
			    transition: opacity 0.5s, box-shadow 0.3s;
			    box-shadow: 2px 2px 8px 0px rgba(0,0,0, 0.3) inset;
			    opacity: 1;
			    }
			
			    footer{
			    margin-top: 20px;
			    }

			    address p{
			    margin: 0;
			    }
			
			    address > p:first-child{
			    margin-bottom: 10px;
			    }
			
			    address > p:last-child{
			    margin-top:10px;
			    }

			    address .admin{
			    margin-left: 10px;
			    }
                      </style>
                    </head>
                    <body>
                        <header>
                            <img alt="PSU Logo" src="logo.png">
                        </header>
                        <article>
                            <section>
                                <p></p>
                            </section>
                            <section>
                                <a href="https://localhost/PSU-Alumni/logIn.php?sign-up-req={$hash}" class="sign-up">Sign Up</a>
                            </section>
                        </article>
                        <footer>
                            <address>
                                <p>Regards,</p>
			        <p>Unit Manager Cooperative Education & Alumni Relations:</p>	
                                <div class="admin"><p><a href="mailto:fahmri@psu.edu.sa">Fahed M. Al-Ahmary</a></p>
			        <p>+966 55 253 2542</p></div>
                                <p>Prince Sultan University</p>
                            </address>
                        </footer>
                    </body>
                </html>
_HTML_;
            sendEmail($address, $subject, $content);
            addInvitedStudent($id, $hash);
            echo "The invitation sent successfully!";
            }
        }

        function undoInvite($id){
            if(removeInvite($id) == 1){
                echo "The invitation removed successfully";
            } else{
                echo "Unexpected behavior!..";          
            }
        }

        function exportToExcel($exportConfigData){
            // Delete oldly created Excel file
            $files = glob('../lib/Excel/*');
            if(isset($files[0])){
                unlink($files[0]);   
            }

            if(!isset($exportConfigData['exportOptions'])){
                return;
            }

            $marginTop = 1;
            $marginLeft = 1;

            include_once('../lib/PHPExcel/IOFactory.php');

            $feildsNum = count($exportConfigData['exportOptions']);
            if(isset($_SESSION['sort'])){
                $sortBy = $_SESSION['sort'];
                unset($_SESSION['sort']);
            }
            $first = NULL;
            $second = NULL;
            if(isset($exportConfigData["groupingOptions"])){
                if(isset($exportConfigData["groupingOptions"]["first"])){
                    $first = trim($exportConfigData["groupingOptions"]["first"]);
                }
                if(isset($exportConfigData["groupingOptions"]["second"])){
                    $second = trim($exportConfigData["groupingOptions"]["second"]);
                }
            }
            $query = excelGroupByQuery($first, $second);
            $q = $GLOBALS['db']->query($query);

            //set the desired name of the excel file
            if(isset($exportConfigData['title'])){
                $fileName = $exportConfigData['title'];
            } else{
                $fileName = "excelSheet";
            }
        
            $objPHPExcel = new PHPExcel();

            // Set document properties
            $objPHPExcel->getProperties()->setCreator("Me")->setLastModifiedBy("Me")->setTitle($exportConfigData['title'])->setSubject($exportConfigData['title'])->setDescription("Excel Sheet")->setKeywords("Excel Sheet")->setCategory("Me");

            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);

            $headerStyle = array('font' => array('size' => 15,'bold' => true,'color' => array('rgb' => '444444')));

            // Printing Feilds Header Name
            for($i=0; $i<$feildsNum; $i++){
                $objPHPExcel->getActiveSheet()->setCellValue( chr(66 + $i) . "" . ($marginTop + 1), $exportConfigData['exportOptions'][$i]);
                $objPHPExcel->getActiveSheet()->getStyle(chr(66 + $i) . "" . ($marginTop + 1))->applyFromArray($headerStyle);
            }

            // Printing Data
            $rows = $q->fetchAll();
            $rowsNum = count($rows);
            for($j = 0; $j < $rowsNum; $j++){
                for($i=0; $i<$feildsNum; $i++){
                    $objPHPExcel->getActiveSheet()->setCellValue( chr(66 + $i) . "" . ($marginTop + 2 + $j), $rows[$j][$exportConfigData['exportOptions'][$i]]);
                }
            }

            // Set worksheet title
            $objPHPExcel->getActiveSheet()->setTitle($fileName);

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('../lib/Excel/' . $fileName . '.xlsx');

            // Redirect output to a client’s web browser (Excel2007)
            /*
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $fileName . '.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');*/
        }
    }
    
        function decodingEditedStudentData($studentInfoArray, $studentDataArray){
         $information = json_decode($studentInfoArray);
         $data = json_decode($studentDataArray);
         insertingStudentEditedData($information, $data);
    }

    function uploadCv($studentID){

        $imgData =file_get_contents($_FILES['fileToUpload']['tmp_name']);
        $uploadOk = 1;

        if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        }

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if( $uploadOk == 1){
            $query = "UPDATE student set C_V = '$imgData' WHERE Student_ID = '$studentID';";
            // echo $query;
            $q = $GLOBALS['db']->query($query);
            }
            else{
                echo "something went wrong";
            }  
    }

} else{
    header("location: ../index.php");
}
?>