<!DOCTYPE html>
<html lang="en">
<head>
	<title>Enter your information</title>
</head>
<body>
	<center>
		<h1>Storing Form data in Database</h1>
		<form action="submit-form-data" method="post" enctype="multipart/form-data">
        <p>
			<label for="num">Enter Number:</label>
            <input type="number" name="num" id="num">
		</p>
        <p>
			<label for="photo">Upload Image:</label>
            <input type="file" name="photo" id="photo">
			</p>
        <p>

			<input type="submit" value="Submit" name="submit">
		</form>
	</center>
</body>
</html>
