<?php 
$conn = new mysqli("localhost","admin","admin","Calculator");
extract($_POST);
$result_set="";
if ($_SERVER["REQUEST_METHOD"] == "POST") { //Form submission 
	$res="";
	$operation="";
	
	switch($caloption)
	{		
		case '+':
		$res=$fn+$sn;
		$operation="Addition";
		break;
		
		case '-':
		$res=$fn-$sn;
		$operation="Subtraction";
		break;
		
		case '*':
		$res=$fn*$sn;
		$operation="Multiplication";
		break;
		
		case '/':
		$res=$fn/$sn;
		$operation="Division";
		break;
		
	}
	
			
            // Check connection
            if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
            } 
			
			//Insert Query
            $sql = "INSERT INTO calculator(calculator_first_number,calculator_second_number,calculator_operation,calculator_result)
			VALUES ($fn,$sn,'$operation',$res)";

            if (mysqli_query($conn, $sql)) {
               echo '<script>alert("New record created successfully")</script>'; 			   
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
			
			//After saving showing the result
			$ressql = "SELECT * from calculator";
			$calresult = $conn->query($ressql);

			if ($calresult->num_rows > 0) {  
			  while($row = $calresult->fetch_assoc()) {
				$result_set .= "<tr><th>" . $row["calculator_first_number"]. "</th><th>" . $row["calculator_second_number"]. "</th><th> " . $row["calculator_operation"]. "</th><th> " . $row["calculator_result"]. "</th></tr>";
				}
			} else {
			  $result_set .=  "<tr><th colspan='4'>No Records Found</th></tr>";
			}

            $conn->close();
	
}else{
	//Page Loading fetching the result and showing
$sql = "SELECT * from calculator";
$result = $conn->query($sql);

if ($result->num_rows > 0) { 
  while($row = $result->fetch_assoc()) {	  
    $result_set .= "<tr>
	<th>" . $row["calculator_first_number"]. "</th>
	<th>" . $row["calculator_second_number"]. "</th>
	<th> " . $row["calculator_operation"]. "</th>
	<th> " . $row["calculator_result"]. "</th>
	</tr>";
	}
} else {
$result_set .=  "<tr><th colspan='4'>No Records Found</th></tr>";
}
$conn->close();

	
}

?>
<!DOCTYP html>
<html>
	<head>
		<title>Calculator - Assignment</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</head>
	<body>
		<form method="post" id="CalculatorForm">
		<table border="1" align="center">
			
			<tr>
				<th>Enter your First Number</th>
				<th><input type="number" name="fn" value="" id="fn"/></th>	
			</tr> 
			<tr>
				<th>Enter your Second Number</th>
				<th><input type="number" name="sn" value="" id="sn"/></th>				
			</tr>
			<tr>
				<th>Select Your Choice</th>
				<th>
				<select name="caloption">
					<option>+</option>
					<option>-</option>
					<option>*</option>
					<option>/</option>
				</select>
				</th>
			</tr>
			<tr>
				
				<th colspan="2">
				<input type="button" name="save" value="Submit" onclick="ValidateAll()"/>
				</th>
			</tr>
		</table>
		</form>
		
		<table border="1" align="center">
		<tr>
			<th>First Number</th>	
			<th>Second Number</th>	
			<th>Operation</th>
			<th>Result</th>
		</tr>	
			<?php  echo $result_set;?>				
		</table>
		
	</body>
</html>

<script>
/*Validating the fields before form submitting*/
function ValidateAll(){
	var fn=$('#fn').val();
	var sn=$('#sn').val();	
	var error_flag=0;
	if(fn == ""){
		alert("You cannot leave first number empty");
		error_flag++;
	}else if(sn == ""){
		alert("You cannot leave second number empty");
		error_flag++;
	}else{
		error_flag=0;
	}
	if(error_flag > 0){
		return false;
	}else{
		$('#CalculatorForm').submit();
	}		
}

</script>
