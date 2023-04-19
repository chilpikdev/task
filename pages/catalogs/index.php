<?php
	include '../../config/db_connect.php';

	$catalogs = mysqli_query($connect, "SELECT * FROM catalogs");
	$catalogs = $catalogs->fetch_all();
?>
<!DOCTYPE html>
<html lang="en">

<?php
	include '../inc/head.php';
?>

<body>
  <div class="container">
    <div class="row">
        <div class="col-sm-3 col-md-3">
		<?php
			include '../inc/menu.php';
		?>
        </div>
        <div class="col-sm-9 col-md-9">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Управление <b>записями</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Добавить новый запись</span></a>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Название</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
					<?php
						foreach ($catalogs as $key => $value) {
					?>
                    <tr>
                        <td><?= $key+1; ?></td>
                        <td><?= $value[1]; ?></td>
                        
                        <td>
                            <a href="#editEmployeeModal" class="edit" data-id="<?= $value[0]; ?>" data-title="<?= $value[1]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#" class="delete" data-id="<?= $value[0]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
					<?php
						}
					?>
                   </tbody>
            </table>
        </div>
    
        </div>
    </div>
</div>
	
    <!-- Edit Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="query.php" method="POST">
					<div class="modal-header">						
						<h4 class="modal-title">Добавить каталог</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Название каталога</label>
							<input type="text" name="title" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Отмена">
						<input type="submit" class="btn btn-success" name="create" value="Сохранить">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="query.php" method="POST">
					<div class="modal-header">						
						<h4 class="modal-title">Изменить каталог</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Название каталога</label>
							<input type="text" name="title" id="updateTitle" class="form-control" required>
						</div>
						<input type="hidden" name="id" id="updateId">
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Отмена">
						<input type="submit" class="btn btn-info" name="update" value="Обновить">
					</div>
				</form>
			</div>
		</div>
	</div>
  
    <script>
        $(document).ready(function(){
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();

		$(".edit").click(function() {
			document.getElementById("updateId").value = this.getAttribute('data-id');
			document.getElementById("updateTitle").value = this.getAttribute('data-title');
			// this.getAttribute('data-catalogid')
			// $('#catalogSelect2 option[value="1"]')
		});

		$(".delete").click(function() {
			var id = this.getAttribute('data-id');

			$.ajax({
				type: 'POST',
				url: 'query.php',
				data: {
					'deleteId': id
				},
				success: function (data) {
					location.reload();
				}
			});	
		});

	    // Select/Deselect checkboxes
        var checkbox = $('table tbody input[type="checkbox"]');
        $("#selectAll").click(function(){
            if(this.checked){
                checkbox.each(function(){
                    this.checked = true;                        
                });
            } else{
                checkbox.each(function(){
                    this.checked = false;                        
                });
            } 
        });
        checkbox.click(function(){
            if(!this.checked){
                $("#selectAll").prop("checked", false);
            }
        });
	});
    </script>
</body>
</html>