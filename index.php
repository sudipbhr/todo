<?php
session_start();
include 'register/conn.php';
$task_name = '';
if (!isset($_SESSION['id'])) {
  	
  	header('location: register/login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['id']);
  	header("location: register/login.php");
  }
  if(isset($_POST['add'])){
    $task= $_POST['task'];
    $id = $_SESSION['id'];
    if(!empty($task)){
      $query = "Insert into task(u_id,task)values('$id','$task')";
      mysqli_query($conn, $query);

    }else{
      echo "Task field cannot be empty";
    }
  }
  // deleting the task
  if(isset($_GET['delete'])){
    $id= $_GET['delete'];
    $query = "Delete from task where t_id=$id";
    mysqli_query($conn,$query);
  }
  // to set the task complete
  if(isset($_GET['done'])){
    $id= $_GET['done'];
    $query = "update task set status=0 where t_id=$id";
    mysqli_query($conn, $query);
  }
  //for editing the records
    if(isset($_GET['edit'])){
    $e_id= $_GET['edit'];
    $query ="select * from task where t_id=$e_id";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
          $task_name = $row['task'];
        }
      }
  }else{
    $e_id= '';
  }
  // for update
  if(isset($_POST['update'])){
    $id = $_POST['id'];
    $task =$_POST['task'];
    $query = "update task set task='$task' where t_id=$id";
    mysqli_query($conn, $query);
    header("location:index.php");
  } 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Todo</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
      integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container">
      <div class="profile">
        <div class="user_details">
          <a href="index.php?logout"><i style="color:red;font-size:50px;padding:10px 0;"class="fa fa-power-off" aria-hidden="true"></i></a>
          <img src="user.jpg" alt="" />
          <p style="">@<?php echo $_SESSION['username'];?></p>
        </div>
        <div class="summary">
          <div class="todo_task">
            <p><?php 
            $id = $_SESSION['id'];
            $query= "select count(t_id) as total from task where status='1' and u_id=$id";
            
             $result = mysqli_query($conn, $query);
            $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo $result[0]['total'];
            ?>
            </p>
            <p>Todo tasks</p>
          </div>
          <div class="complete">
            <p><?php 
            $id = $_SESSION['id'];
            $query= "select count(t_id) as total from task where status='0' and u_id=$id";
            
            $result = mysqli_query($conn, $query);
            $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo $result[0]['total'];
            ?></p>
            <p>Completed tasks</p>
          </div>
        </div>
      </div>
      <div class="todo">
        <div class="add_task">
          <form action="" method="post">
            <div>
              <input type="hidden"  name="id" value="<?php echo $e_id;?>">
              <input type="text" name="task" value="<?php echo $task_name ? $task_name : "";?>" placeholder="Please add your task here"/>
              <input
              <?php
                if ($e_id ==""){
                  echo '
                    value="Add"
                    name="add"
                  ';
                }else{
                  echo '
                    value="Update"
                    name="update"

                  ';
                }
              ?>
                type="submit"
                class="button_submit"
              />
            </div>
          </form>
        </div>
        <div class="task">
          <h5>Tasks</h5>
          <div class="task_list">
            <ul>
              <?php
              $id = $_SESSION['id'];
              $query= "Select * from task where u_id=$id";
              $result= mysqli_query($conn, $query);
             $row=mysqli_fetch_all($result, MYSQLI_ASSOC);?>
             <?php
                foreach($row as $row):
                 $class = $row['status'] == 0 ? "complete" : "";
                ?>
               
                <li>
                <p class="<?php echo $class ?>"><?php echo $row['task'];?></p>
                <div class="button">
                  <a class="delete" href="index.php?delete=<?php echo $row['t_id']; ?>"
                    ><i class="fa-solid fa-trash"></i
                  ></a>
                  <a class="edit" href="index.php?edit=<?php echo $row['t_id']; ?>"
                    ><i class="fa-solid fa-pen-to-square"></i
                  ></a>
                  <a class="complete" href="index.php?done=<?php echo $row['t_id']; ?>""
                    ><i class="fa-solid fa-check"></i
                  ></a>
                </div>
              </li>       
<?php endforeach;?>


            </ul>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
