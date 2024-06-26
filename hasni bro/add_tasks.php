<?php
include('db/db_conn.php');
include('header.php');
?>
<script>
function goerror()
{ window.location.replace("access");}
</script>
<?php
$email=$_SESSION['email'];
$select ="SELECT  * FROM `users` WHERE email = '$email' and powers like '%task-new%' ";
$result= mysqli_query($connection,$select);
if ( $result->num_rows == 0 ){
  echo "<script type='text/javascript'>goerror()</script>";
}
$select1="SELECT MAX(task_id) AS max FROM task_msrt";
$result1= mysqli_query($connection,$select1);
$dataRow1=mysqli_fetch_array($result1);
$dataRow1 = ++$dataRow1['max'];
$sql2 = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email'");
$res2 = mysqli_fetch_array($sql2);
$name =  $res2['first_name']. " " .$res2['last_name'] ; 
?>
<link rel="stylesheet" href="Assets/css/style2.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
<link rel="stylesheet" href="Assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<section>
  <div class="box box-info col-md-8">
    <div class="box-header with-border">
      <h3 class="box-title">Add New Task</h3>
    </div>
    <form action="taskpro" method="POST" id="taskform" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Task ID</label>
          <div class="col-sm-8">
            <input type="number" readonly="task_id" class="form-control" id="tast_id" name="txtid" value="<?php echo $dataRow1; ?>"/>
          </div>
        </div>
        <br><br>
        <div class="form-group">
          <label class="col-sm-2 control-label">Company Name</label>
           <div class="col-sm-8">
            <select name="comname" id="com" class="form-control select2" onchange="getcom_email()"required="">
              <option value="" disabled selected hidden>Please Choose</option>
              <?php
                $sql1 = mysqli_query($connection,"SELECT * FROM cmpny_mrst");
                $row1 = mysqli_num_rows($sql1);
                while ($row1 = mysqli_fetch_array($sql1))                                
                {                                
                echo "<option  value='". $row1['cmpny_id'] ."'>" .$row1['cmpny_name'] ."</option>" ;
                }
              ?>
            </select>
            <input type="text" name="email2" id="email2" hidden="">
          </div>
        </div>
        <br><br>
        <div class="form-group">
          <label class="col-sm-2 control-label">Customer Name</label>
          <div class="col-sm-8">
            <select name="ctname" id="ctname" class="form-control select2"required="">
              <option value="" disabled selected hidden>Please Choose</option>
              <?php
                $sql = mysqli_query($connection,"SELECT * FROM ctms_msrt WHERE is_hide = 0 ORDER BY customer_name ASC");
                $row = mysqli_num_rows($sql1);
                while ($row = mysqli_fetch_array($sql))                                
                {                                
                  echo "<option  value='". $row['cust_id'] ."'>" .$row['customer_name'] ."</option>" ;
                }
              ?>
            </select>
          </div>
          <input type="button" class="btnsearch" id="myBtn" name="" value="Details">
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Project</label>
          <div class="col-sm-8">
            <select name="proname" class="form-control select2" required="">
              <option value="" disabled selected hidden>Please Choose</option>
              <?php
                $sql1 = mysqli_query($connection,"SELECT * FROM prdct_msrt ORDER BY prdct_name ASC");
                $row1 = mysqli_num_rows($sql1);
                while ($row1 = mysqli_fetch_array($sql1))                                
                {                                
                echo "<option  value='". $row1['prdct_id'] ."'>" .$row1['prdct_name'] ."</option>" ;
                }
              ?>
            </select>
          </div>
        </div>
        <br><br><br>
        <div class="form-group">
          <label class="col-sm-2 control-label">Type</label>
          <div class="col-sm-8">
            <select name="type" class="form-control" required="">
              <option value="" disabled selected hidden>Please Choose</option>
              <option >Call</option>
              <option>Meeting</option>
              <option>Cheque Collect</option>
              <option>Interview</option>
              <option>Field Visit</option>
              <option >Devolopement</option>
              <option>Testing</option>
              <option>Analizing</option>
              <option>Interview</option>
              <option>Quotation</option>
              <option >Presentation</option>
              <option>Demostration</option>
              <option>Invoicing</option>
              <option>Training</option>
              <option>Designing</option>
              <option>Modification</option>
              <option>Support</option>
            </select>
          </div>
        </div>
        <br><br>
        <div class="form-group">
          <label class="col-sm-2 control-label">Name</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="name" required="" name="txtname" placeholder="Enter..."/>
          </div>
        </div>
        <br><br>
        <div class="form-group">
          <label class="col-sm-2 control-label">Status</label>
          <div class="col-sm-8">
            <select name="status" class="form-control" required="">
              <option value="" disabled selected hidden>Please Choose</option>
              <optgroup label="Open">
                <option value="Open">Open</option>
                <option value="Re-Open">Re-open</option>
              </optgroup>
              <optgroup label="Done">
                <option value="Done">Done</option>
              </optgroup>
            </select>
          </div>
        </div>
        <br><br>
        <div class="form-group">
          <label class="col-sm-2 control-label">Priority</label>
          <div class="col-sm-8">
            <select name="priority" class="form-control" required="">
              <option value="" disabled selected hidden>Please Choose</option>
              <option >Unknown</option>
              <option>Low</option>
              <option>Medium</option>
              <option>High</option>
              <option>Urgent</option>
            </select>
          </div>
        </div>
        <br><br>
        <div class="form-group">
          <label class="col-sm-2 control-label">Label</label>
          <div class="col-sm-8">
            <select  name="label" class="form-control" required="">
              <option value="" disabled selected hidden>Please Choose</option>
              <option>Task</option>
              <option>Change</option>
              <option>Idea</option>
              <option>Bug</option>
              <option>Issue</option>    
            </select>
          </div>
        </div>
        <br><br>
        <div class="form-group">
          <label class="col-sm-2 control-label">Date Range</label>
          <div class="from-control">
            <div class="col-sm-8">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                </div>
                <input type="text" name="date" class="form-control pull-right" id="reservationtime">
              </div>
            </div>
            <br><br>
          </div>
        </div>
        <div class="form-group doc_row box-body" style="margin-left: -10px">
          <label class="col-sm-2 control-label">Attach Document</label>
          <input type="hidden" name="size" value="1000000">
          <div class="col-sm-8">  
            <input type="file" name="file[]" class="col-sm-2 form-control">
          </div>
          <input type="button" name="" id="btn" value="+" style="background: transparent; border-color: lightblue; font-size: 20px;"> 
        </div>
        <br><br>
        <div class="form-group"  >
          <label class="col-sm-2 control-label">Assign To</label> 
          <div class="col-sm-3 table-responsive" style="max-height: 150px; overflow-y: scroll;" style="display: inline;">
            <?php
              $sql3 = mysqli_query($connection,"SELECT first_name,last_name FROM users");
              $row3 = mysqli_num_rows($sql3);
              while ($row3 = mysqli_fetch_array($sql3))                                
                {      
              echo "<label class='container'> <input type='checkbox' id='assign' name='assign[]' value='". $row3['first_name'].' ' .$row3['last_name']  ."'>". $row3['first_name'].' ' .$row3['last_name']  ." <span class='checkmark'></span> </label> <br>";
                }
            ?>
          </div>
        </div>
        <br><br><br><br><br>
        <div class="form-group">
          <label class="col-sm-2 control-label">Description</label>
          <div class="from-control">
            <div class="col-sm-8">
              <div class="box-body pad">
                <textarea id="editor1" name="editor1" rows="1" cols="1">
                </textarea>
              </div>
            </div>
          </div>
        </div>
        <br><br>
      </div>
      <div class="form-group" align="center">
        <label class="col-sm-16  control-label">Assigned By - <?php echo $name; ?></label>
        <input type="text" name="assign_by" class="hidden" value="<?php echo $name; ?>">
      </div>
      <div class="btnadd pull-right">
        <button type="submit" class="btnsubmit" > <span class="tooltiptext">Save</span> </button>
      </div>
      <div class="btnadd pull-right">
        <button type="reset" class="btncancel" onclick= "location.href = 'task';"><i class="fa fa-close"></i></button>
        <span class="tooltiptext">Cancel</span>
      </div>
    
<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content" >
    <div class="modal-header">
      <span class="close">&times;</span>
    </div>
    <div class="modal-body" style="margin: auto;" >
      <br>
      <div class="" align="center" id="Name" >
      </div>
      <br><br>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Contact person</th>
            <th>Designation</th>
            <th>Tel</th>
            <th>Email</th>        
          </tr>
        </thead>
        <tbody>
      </table>
    </div>
    <div class="modal-footer">
      <div class="btnadd pull-right">
      </div>
    </div>
  </div>
</div>
<!-- jQuery 3 -->
<script src="Assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="Assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="Assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="Assets/plugins2/input-mask/jquery.inputmask.js"></script>
<script src="Assets/plugins2/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="Assets/plugins2/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="Assets/bower_components/moment/min/moment.min.js"></script>
<script src="Assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="Assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="Assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="Assets/plugins2/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="Assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="Assets/plugins2/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="Assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="Assets/dist2/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="Assets/dist2/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('#reservationtime').daterangepicker({ 
      timePicker: true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(32, 'hour'),
    locale: {
      format: 'MM/DD/YYYY hh:mm A'
    }
    })
  })
</script>            
<!-- Bootstrap 3.3.6 -->
<script src="Assets/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="Assets/plugins/fastclick/fastclick.js"></script>
<!-- bootstrap datepicker -->
<script src="Assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- AdminLTE App -->
<script src="Assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="Assets/dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="Assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
  });
</script>
<script>
  $('#datepicker').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
  $('#datepicker1').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
// Get the modal
var modal = document.getElementById('myModal');
// Get the button that opens the modal
var btn = document.getElementById("myBtn");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal 
btn.onclick = function() {
var id = document.getElementById('ctname').value;
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function(){
if (this.readyState == 4 && xmlhttp.status == 200){
var respons = xmlhttp.responseText.trim();
if(respons="done"){
getcon();
  }
document.getElementById('Name').innerHTML = this.responseText;
// console.log(respons);
  }
}
xmlhttp.open("GET", "cusd.php?id=" + id, true);
xmlhttp.send();
// console.log(name);
modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function getcon(){
var id = document.getElementById('ctname').options[document.getElementById('ctname').selectedIndex].text;
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function(){
if (this.readyState == 4 && xmlhttp.status == 200){
document.getElementById('example1').innerHTML = this.responseText;
// console.log(respons);
  }
}
xmlhttp.open("GET", "cond.php?id=" + id, true);
            xmlhttp.send();
}
 $("#btn").click(function(){
console.log('came');
$(".doc_row:last").after(' <div class="form-group doc_row box-body"> <label class="col-sm-2 control-label"></label><input type="hidden" name="size" value="1000000"><div class="col-sm-8"><input type="file" name="file[]" class="col-sm-2 form-control"><br></div></div>');
  bind();
});
function getcom_email(){
// console.log("came");
var id = document.getElementById('com').value;
// console.log(id);
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function(){
  if (this.readyState == 4 && xmlhttp.status == 200){
  document.getElementById('email2').value = this.responseText;
// console.log(this.responseText);
  }
}
xmlhttp.open("GET", "com_email.php?id=" + id, true);
xmlhttp.send();
}
$(window).ready(function() {
$('#taskform').submit(function() {
// alert($(":checkbox:checked").length);
var len = $(":checkbox:checked").length;
// alert(len);
if ( len < 0 || len == 0 || len == "0") {
alert("Please assign this task to minimum 1 user");
  return false;
    }
  return true;
    });
});
</script>
</form>
</div>
</html>
<?php
include('footer.php');
?>