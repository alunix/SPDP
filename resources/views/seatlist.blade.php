@extends('layouts.app')

@section('content')


<!--seatlist.blade.php dlm folder seat-->
	 

	 		<form id="book" method="post" action="{{ action('BookSeatController@create') }}">

	<?php 
// return total seat
    echo  "Num of seat: " .$buses[0]."<br />" ;

	
$myArray=array(); //create array for seats

	
	for ($x =1; $x <= $buses[0]; $x++) {
		
    $myArray = array($x => $x ); //push seat number to array 

     ?>

      <div class="checkbox">
  <label><input type="checkbox" name="checkboxvar[]" value="{{ $x }}" > </label>


      
<?php 

foreach ($myArray as $key=>$value) {
	print "seat number: ". $value;   //print all seat number
}
} 

?>
<br>
 <input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type='submit' name="submit" class='buttons'>
</form>
<?php


/*if (isset($_POST['submit'])) {

	foreach($_POST['checkboxvar'] as $check) {
            echo $check;
	
	
} }*/


?>

      








	
	





@endsection
