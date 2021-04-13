

<?php
$connect = mysqli_connect("localhost", "root", "", "gastromed");
$output = '';

if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM patient 
	WHERE nom LIKE '%".$search."%'
	OR prenom LIKE '%".$search."%' 
	
	";
}
else
{
	$query = "
	SELECT * FROM patient ORDER BY date_creation LIMIT 10";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	
	while($y = mysqli_fetch_array($result))
	{
		$output .= '           <tr>
        <td> ' . $y['nom'] . '</td>
        <td>' . $y['prenom'] . '</td>
        <td>' . $y['age'] . '</td>
        <td>' . $y['date_creation'] . '</td>
        <td>' . $y['date_creation'] . '</td>
        <td class="text-right">
            <div class="dropdown dropdown-action consulte">
                <a href="#" class="action-icon dropdown-toggle consulte" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class=" consulte dropdown-item" href="#" id="' . $y['Code_patient'] . '"><i class="fa fa-id-card-o  m-r-5"></i> Consulter</a>
                    <a class="dropdown-item" href="edit-patient.html"><i class="fa fa-pencil m-r-5"></i> Editer</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Suprimer</a>
                </div>
            </div>
        </td>
    </tr>
';
	}
	echo $output;
}
else
{
	echo 'Aucun Résultat';
}
?>

