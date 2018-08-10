<?php 
require_once('connection.php');
	if(!isset($_SESSION['userName'])){
        header("location:index.php");
    }
    else{
        $login=TRUE;
    }
if(isset($_GET['action']))
{
	$action=$_GET['action'];
    switch($action){
    case 'edit':
			$tid = $_GET['tid'];
			$sid = $_GET['sid'];
			/*$testName = $_POST['editTestName'];*/
			/*$count = count($_POST['qid']);
            echo $count;*/
			/*$updateSql="UPDATE mst_question SET test_name='".$testName."',total_question='".$qusCount."' WHERE id='".$tid."'";*/
			$count=0;
            foreach($_POST['qid'] as $id){
              $updateSql="UPDATE mst_question SET ques_details='".$_POST['qus'][$count]."',
                                                    ans1='".$_POST['ans1'][$count]."',
                                                    ans2='".$_POST['ans2'][$count]."',
                                                    ans3='".$_POST['ans3'][$count]."',
                                                    ans4='".$_POST['ans4'][$count]."',
                                                    correct_ans='".$_POST['correct'][$count]."'
                                                    WHERE id='".$_POST['qid'][$count]."'";
                echo $updateSql;
               mysqli_query($con,$updateSql);
                $count++;

            }
            
			header('location:question.php?sid='.$sid.'&tid='.$tid);
			
	       break;
    case 'addNew':
            $tid = $_GET['tid'];
			$sid = $_GET['sid'];
            
            $count=count($_POST[qus]);
            $values = '';
            for($i=0;$i<$count;$i++){
               $values = $values ."('".$tid."','".$_POST['qus'][$i]."','".$_POST['ans1'][$i]."','".$_POST['ans2'][$i]."','".$_POST['ans3'][$i]."','".$_POST['ans4'][$i]."','".$_POST['correct'][$i]."')";
              if($i<>($count-1)){
                  $values =$values.',';
              }
            
            }
             echo $values;                                       
            $insertSQL = "INSERT INTO mst_question (test_id,ques_details,ans1,ans2,ans3,ans4,correct_ans) VALUES".$values;
            if(mysqli_query($con,$insertSQL)){
                header("location:question.php?sid=".$sid."&tid=".$tid);
            }
            break;
        case 'del':
            $tid=$_GET['tid'];
			$sid = $_GET['sid'];
			$delSql = "UPDATE mst_question SET enable = 0 WHERE
			id='".$_GET['qid']."'";
			if(mysqli_query($con,$delSql)){
				header('location:question.php?sid='.$sid."&tid=".$tid);
			}
			break;
    }
}

?>