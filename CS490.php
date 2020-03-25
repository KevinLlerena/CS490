 <?php
 include 'data.php';
if ($_POST['version'] == 'login') {

      $username = $_POST[j_username];
      $username = strtolower($username);
      $password = $_POST[j_password];
      $hashPW = md5($password);

      $sql = "SELECT * FROM Log_ID WHERE Username = \"$username\" AND Pass = \"$hashPW\"";
      $result = $link->query($sql);
   
      if ($result->num_rows > 0) {
       
        
          while($row = $result->fetch_assoc()) {
                            
                  $output = $row[Username];
                  $output2 = $row[Pass];
                  $output3 = $row[Usertype];
        
                  if(strcmp($username,$output) == 0 && strcmp($hashPW,$output2) == 0 )
                  {
                  
                    $account->account = "yes";
                    $account->Usertype = $output3;  
                    $account = json_encode($account);
       
                  echo $account;    

                  }

          }
      } 
                   else{
                   $account->account = "no";
                   $account = json_encode($account);
                      echo $account; 
                  }
}else if($_POST['version'] == 'requestNumber'){ //request number is the name the version should be labeled 
      
      //$num = 5; //this is just a test sample to check if it works
      $num = $_POST['number'];     //                    number ias how you should label it in post request 
      
      $requestQuestion = "SELECT * FROM myBank WHERE Number = \"$num\" ";
      $result = $link->query($requestQuestion);
       
       if ($result->num_rows > 0) {
       
        
          while($row = $result->fetch_assoc()) {
                                            
                    $results[] = $row;                         
          } 
                    $results = json_encode($results);
                    echo $results;    
      }
                   else{
                   $results->Results = "number does not exist ";
                   $results = json_encode($results);
                      echo $results; 
                   } 
}else if ($_POST['version'] == 'requestExam') {

      $examName = $_POST['testname'];
      $studentId = $_POST['studentname'];
      
      $findExam = "SELECT * from dummyexams WHERE testname = \"$examName\" AND studentname = \"$studentId\"";
      $result = $link->query($findExam);

       if ($result->num_rows > 0) {


          while($row = $result->fetch_assoc()) {

                    $results[] = $row;
          } 
                    $results = json_encode($results);
                    echo $results;
      }
      else{
                   $results->Results = "exam does not exist ";
                   $results = json_encode($results);
                      echo $results; 
      }

}else if ($_POST['version'] == 'report') {

      $examName = $_POST['testname'];
      $studentId = $_POST['studentname'];
      $grades = $_POST['test'];
      
      //echo "<br>.$examName.<br>.$studentId.<br>";
      //echo "this is the grade report ";
      //echo var_dump($_POST);
      //echo "<br>this is the end of grade report"; 
      
      $findExam = "UPDATE dummyexams SET gradereport = \"$grades\" WHERE testname = \"$examName\" AND studentname = \"$studentId\"";
     // echo "<br>".$findExam."<br>";
      $result = $link->query($findExam);
      
       $results->Report = "grade report added ";
                  $results = json_encode($results);
                  echo $results;

}else if($_POST['version'] == 'search'){

      $level = $_POST[Difficulty];
      $type = $_POST[Category];
      
      $Questions = "SELECT * FROM myBank WHERE Difficulty = \"$level\" AND Type = \"$type\"";
      $result = $link->query($Questions);
       
      if ($result->num_rows > 0) {
       
        for($i = 1; $i<$result->num_rows; $i++)
          while($row = $result->fetch_assoc()) {
                            
                    $Results[] = $row;
          }
          $Results = json_encode($Results);
          echo $Results;
          //echo var_dump($Results);//  Results[] has the data but when you json encode it it gets bool false 
      } 
      else{
              $Results->Results = "no such questions stored";
              $Results = json_encode($Results);
              echo $Results; 
      }

}else if ($_POST['version'] == 'add') {
     // echo var_dump($_POST);
      $Question = $_POST[Question];
      $Question = str_replace('"', '\"', $Question);
      $p1 = $_POST[p1];
      $p1 = str_replace('"', '\"', $p1);
      $r1 = $_POST[r1];
      $r1 = str_replace('"', '\"', $r1);
      $p2 = $_POST[p2];
      $p2 = str_replace('"', '\"', $p2);
      $r2 = $_POST[r2];
      $r2 = str_replace('"', '\"', $r2);
      $p3 = $_POST[p3];
      $p3 = str_replace('"', '\"', $p3);
      $r3 = $_POST[r3];
      $r3 = str_replace('"', '\"', $r3);
      $p4 = $_POST[p4];
      $p4 = str_replace('"', '\"', $p4);
      $r4 = $_POST[r4];
      $r4 = str_replace('"', '\"', $r4);
      $p5 = $_POST[p5];
      $p5 = str_replace('"', '\"', $p5);
      $r5 = $_POST[r5];
      $r5 = str_replace('"', '\"', $r5);
      $p6 = $_POST[p6];
      $p6 = str_replace('"', '\"', $p6);
      $r6 = $_POST[r6];
      $r6 = str_replace('"', '\"', $r6);
      $type = $_POST[questionCat];
      $difficulty = $_POST[questionDiff];
        
      $addQuestion = "INSERT INTO myBank (Question,Difficulty,Type,Test_Case_1,Test_Case_Result_1,Test_Case_2,Test_Case_Result_2,Test_Case_3,Test_Case_Result_3,Test_Case_4,Test_Case_Result_4,Test_Case_5,Test_Case_Result_5,Test_Case_6,Test_Case_Result_6) VALUES (\"$Question\",\"$difficulty\",\"$type\",\"$p1\",\"$r1\",\"$p2\",\"$r2\",\"$p3\",\"$r3\",\"$p4\",\"$r4\",\"$p5\",\"$r5\",\"$p6\",\"$r6\")";
      $result = $link->query($addQuestion);
      // echo var_dump($addQuestion);
          $Results->Results = "Question added to database";
          $Results = json_encode($Results);
          echo $Results; 
   
}else if ($_POST['version'] == 'makeExam') {
      
      //echo var_dump($_POST);
      $examName = $_POST['testname'];
      $question1 = $_POST['question1number'];
      $question2 = $_POST['question2number'];
      $question3 = $_POST['question3number'];
      $question4 = $_POST['question4number'];
      $question5 = $_POST['question5number'];      
      $report = $_POST['gradereport'];
      
      $question1a = $_POST['question1points'];
      $question2a = $_POST['question2points'];
      $question3a = $_POST['question3points'];
      $question4a = $_POST['question4points'];
      $question5a = $_POST['question5points'];
      
      //the set up for five questions
      if(empty($question1) == FALSE && empty($question2) == FALSE && empty($question3) == FALSE && empty($question4) == FALSE && empty($question5) == FALSE && empty($question1a) == FALSE &&empty($question2a) == FALSE &&empty($question3a) == FALSE &&empty($question4a) == FALSE &&empty($question5a) == FALSE){
      
      $addExam = "INSERT INTO dummyexams (testname,studentname,question1number,question1points,question2number,question2points,question3number,question3points,question4number,question4points,question5number,question5points,gradereport) VALUES (\"$examName\",\"$studentId\",\"$question1\",\"$question1a\",\"$question2\",\"$question2a\",\"$question3\",\"$question3a\",\"$question4\",\"$question4a\",\"$question5\",\"$question5a\",\"$report\")";
      $result = $link->query($addExam);

          $Results->Results = "Exam added ";
          $Results = json_encode($Results);
          echo $Results; 
      }//the set up for four questions
      else if(empty($question1) == FALSE && empty($question2) == FALSE && empty($question3) == FALSE && empty($question4) == FALSE && empty($question1a) == FALSE && empty($question2a) == FALSE && empty($question3a) == FALSE && empty($question4a) == FALSE){
      //echo var_dump($_POST);
      $addExam = "INSERT INTO dummyexams (testname,studentname,question1number,question1points,question2number,question2points,question3number,question3points,question4number,question4points,gradereport) VALUES (\"$examName\",\"$studentId\",\"$question1\",\"$question1a\",\"$question2\",\"$question2a\",\"$question3\",\"$question3a\",\"$question4\",\"$question4a\",\"$report\")";
      $result = $link->query($addExam);

          $Results->Results = "Exam added ";
          $Results = json_encode($Results);
          echo $Results; 
      }//the set up for three questions
      else if(empty($question1) == FALSE && empty($question2) == FALSE && empty($question3) == FALSE && empty($question1a) == FALSE && empty($question2a) == FALSE && empty($question3a) == FALSE){
      //echo var_dump($_POST);
      $addExam = "INSERT INTO dummyexams (testname,studentname,question1number,question1points,question2number,question2points,question3number,question3points,gradereport) VALUES (\"$examName\",\"$studentId\",\"$question1\",\"$question1a\",\"$question2\",\"$question2a\",\"$question3\",\"$question3a\",\"$report\")";
      $result = $link->query($addExam);

          $Results->Results = "Exam added ";
          $Results = json_encode($Results);
          echo $Results; 
      }    
      else{
          $Results->Response = "Exams must be 3 to 5 questions long with point values assigned to each question check your input ";
          $Results = json_encode($Results);
          echo $Results;
      }
}else if ($_POST['version'] == 'searchExam') {
      
      $findExam = "SELECT testname from dummyexams ";
      $result = $link->query($findExam);

       if ($result->num_rows > 0) {


          while($row = $result->fetch_assoc()) {

                    $results[] = $row;
          } 
                    $results = json_encode($results);
                    echo $results;
      }
      else{
                   $results->Results = "exam does not exist ";
                   $results = json_encode($results);
                      echo $results; 
      }

}
else if ($_POST['version'] == 'submitExam') {
      
      $examName = $_POST['testname'];
      
      $unleash = "UPDATE dummyexams SET releaseExams = \"yes\" WHERE testname = \"$examName\"";
      $result = $link->query($unleash);
      
       $results->Report = "Exams release ";
                   $results = json_encode($results);
                      echo $results;
                      
      $closeExams = "UPDATE dummyexams SET releaseExams = \"no\" WHERE testname != \"$examName\"";
      $result = $link->query($closeExams);
                      

}
else if ($_POST['version'] == 'getExam') {
      
      
      $findExam = "SELECT * from dummyexams WHERE releaseExams = \"yes\"";
      $result = $link->query($findExam);

       if ($result->num_rows > 0) {
  

          while($row = $result->fetch_assoc()) {

                  $output = $row[question1number];
                  $output2 = $row[question2number];
                  $output3 = $row[question3number];
                  $output4 = $row[question4number];
                  $output5 = $row[question5number];
                  $examName->examName = $row[testname];
                  
          }
        if(empty($output) == FALSE && empty($output2) == FALSE && empty($output3) == FALSE && empty($output4) == FALSE && empty($output5) == FALSE)  
        $findQuestion1 = "SELECT question,Number,Test_Case_1 FROM myBank WHERE Number IN  ($output,$output2,$output3,$output4,$output5)";
        else if(empty($output) == FALSE && empty($output2) == FALSE && empty($output3) == FALSE && empty($output4) == FALSE)  
        $findQuestion1 = "SELECT question,Number,Test_Case_1 FROM myBank WHERE Number IN  ($output,$output2,$output3,$output4)";
        else if(empty($output) == FALSE && empty($output2) == FALSE && empty($output3) == FALSE)  
        $findQuestion1 = "SELECT question,Number,Test_Case_1 FROM myBank WHERE Number IN  ($output,$output2,$output3)";

   
        //echo var_dump($findQuestion1);
        $result2 = $link->query($findQuestion1);

       if ($result2->num_rows > 0) {


          while($row2 = $result2->fetch_assoc()) {
                   $results2[] = $row2;
         
          }        
                    array_push($results2, $examName);
                    $results2 = json_encode($results2);
                     
      }
      echo $results2;
     
      }
}else if ($_POST['version'] == 'studentExam') {
      
          
      $studentId = $_POST['studentname'];
      $testName = $_POST['testname'];
      $q1answer = $_POST['question1answer'];
      $q2answer = $_POST['question2answer'];
      $q3answer = $_POST['question3answer'];
      $q4answer = $_POST['question4answer'];
      $q5answer = $_POST['question5answer'];
       
      $submitStudentExam = "UPDATE dummyexams SET question1answer = \"$q1answer\",question2answer = \"$q2answer\",question3answer = \"$q3answer\",question4answer = \"$q4answer\",question5answer = \"$q5answer\", studentName = \"$studentId\" WHERE testname = \"$testName\"";
      
      $result = $link->query($submitStudentExam);
      
       $results->Results = "exam submitted ";
                   $results = json_encode($tosend);
                      echo $results;
      $tosend = array(
       'version' => 'doGrade',
       'testname' => $testName,
       'studentname' => $studentId
        ); 
	$searchCH= curl_init(); 
	curl_setopt($searchCH, CURLOPT_URL, "https://web.njit.edu/~djb58/cs490/execphp.php");
	curl_setopt($searchCH, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($searchCH, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
	curl_setopt($searchCH, CURLOPT_POST, true); 
	curl_setopt($searchCH, CURLOPT_POSTFIELDS, $tosend); 
	$output =curl_exec($searchCH); 
	curl_close($searchCH);
	echo $output;

}else if ($_POST['version'] == 'releaseGrades') {
      
      $examName = $_POST['testname'];
      
      $releash = "UPDATE dummyexams SET releaseGrades = \"no\" WHERE testname != \"$examName\"";
      $result = $link->query($releash);
      $unleash = "UPDATE dummyexams SET releaseGrades = \"yes\" WHERE testname = \"$examName\"";
      $result = $link->query($unleash);
      
      
       $results->Report = "grades released ";
                   $results = json_encode($results);
                      echo $results;

}else if ($_POST['version'] == 'viewGrades'){
      
      
      $studentId = $_POST['studentname'];
      
      $getGrades = "SELECT gradereport,testname FROM dummyexams where studentname = \"$studentId\" AND releaseGrades = \"yes\"";
      
      $result = $link->query($getGrades);
      
      if ($result->num_rows > 0) {


          while($row = $result->fetch_assoc()) {

                    $results[] = $row;
          } 
                    $results = json_encode($results);
                    echo $results;
      }
      else{
                   $results->Results = "grades not up ";
                   $results = json_encode($results);
                      echo $results; 
      }
      
    
}else if ($_POST['version'] == 'manualGrades'){
//echo var_dump($_POST);

      /*
      $sql = "SELECT Username FROM Log_ID WHERE Usertype = \"student\"";
      $result = $link->query($sql);
       
       if ($result->num_rows > 0) {

          while($row = $result->fetch_assoc()) {
                                            
                    $results[] = $row;                         
          } 
                    $results = json_encode($results);
                    echo $results;    
      }
                   else{
                   $results->Results = "Problem in student manual grades grabbing student";
                   $results = json_encode($results);
                      echo $results; 
                   } 
      */
      //echo var_dump($_POST);
      /*
      $studentID = $_POST['student'];
      $sql = "SELECT * FROM dummyexams WHERE studentname = \"$studentID\" AND releaseGrades = \"yes\"";
      $result = $link->query($sql);
       
       if ($result->num_rows > 0) {

          while($row = $result->fetch_assoc()) {
                                            
                    $results[] = $row;                         
          } 
                    $results = json_encode($results);
                    echo $results;    
      }
                   else{
                   $results->Results = "Problem in student manual grades grabbing student";
                   $results = json_encode($results);
                      echo $results; 
                   }
                   
           
       */    
     // echo var_dump($_POST);
      $studentID = $_POST['student'];
      $sql = "SELECT * FROM dummyexams WHERE studentname = \"$studentID\" AND releaseGrades = \"yes\"";
      $result = $link->query($sql);

       if ($result->num_rows > 0) {
  
        
          while($row = $result->fetch_assoc()) {
          
                  $output = $row[question1number];
                  $output2 = $row[question2number];
                  $output3 = $row[question3number];
                  $output4 = $row[question4number];
                  $output5 = $row[question5number];
                  $results[] = $row;
                  
          }
          
        $sql2 = "SELECT question FROM myBank WHERE Number IN  ($output,$output2,$output3,$output4,$output5)";   

        $result2 = $link->query($sql2);
        $i = 0;
       if ($result2->num_rows > 0) {


          while($row2 = $result2->fetch_assoc()) {
                   $results2[] = $row2;
                   //echo var_dump($row2);
         
          }        
                    array_push($results2, $results);
                    $results2 = json_encode($results2);
                    echo $results2;
                     
      }
      
      //echo $results2;
     
      } 
      
      
}
?>