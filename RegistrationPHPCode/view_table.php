<?php
include 'config.php';
?>

<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid navajowhite;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: navajowhite;
}
</style>
</head>
<body>

<center><h2 style="color:crimson;">Admin Table</h2></center>
<br><br>
<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>EMail</th>
	<th>Password</th>
	<th>User Type</th>
	<th>Profile</th>
	<th>Update</th>
	<th>Remove</th>
  </tr>
  <?php
$result=mysqli_query($conn,"SELECT * FROM `user_form`");
while($row=mysqli_fetch_array($result))
{ 
  ?>
  <tr>
<td><?php echo $row["id"]; ?></td>
<td><?php echo $row["name"]; ?></td>
<td><?php echo $row["email"]; ?></td>
<td><?php echo $row["password"]; ?></td> 
<td><?php echo $row["user_type"]; ?></td> 
<td><img src="images/<?php echo $row["profile"]; ?>" height="100px" width="100px"></td>


<td><a href="edit_table.php?uID=<?php echo $row["id"]; ?>">Update</a></td>
<td><a href="delete_table.php?ID=<?php echo $row["id"]; ?>">Remove</a></td>
</tr>
<?php } ?>
</table>

</body>
</html>