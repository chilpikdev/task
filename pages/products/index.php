<?php
	include '../../config/db_connect.php';

	// $products = mysqli_query($connect, "SELECT  id, title, price, promoprice, promostart, promoend FROM products");
	$products = mysqli_query($connect, "SELECT * FROM products");
	$products = $products->fetch_all();

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
                        <th>Цена</th>
						<th>Цена акции</th>
                        <th>Начало акции</th>
                        <th>Конец акции</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
					<?php
						foreach ($products as $key => $value) {
					?>
                    <tr>
                        <td><?= $key+1; ?></td>
                        <td><?= $value[3]; ?></td>
                        <td><?= $value[4]; ?></td>
                        <td><?= $value[5]; ?></td>
                        <td><?= $value[6]; ?></td>
                        <td><?= $value[7]; ?></td>
                        
                        <td>
                            <a href="#editEmployeeModal" class="edit" data-id="<?= $value[0]; ?>" data-catalogid="<?= $value[1]; ?>" data-categoryid="<?= $value[2]; ?>" data-title="<?= $value[3]; ?>" data-price="<?= $value[4]; ?>" data-promoprice="<?= $value[5]; ?>" data-promostart="<?= $value[6]; ?>" data-promoend="<?= $value[7]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
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
						<h4 class="modal-title">Добавить запись</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Название</label>
							<input type="text" name="title" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Каталог</label>
							<select name="catalog_id" id="catalogSelect" class="form-control" required>
								<option disabled selected value> -- выберите каталог -- </option>
								<?php
								foreach ($catalogs as $value) {
								?>
								<option value="<?= $value[0] ?>"><?= $value[1] ?></option>
								<?php
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Категория</label>
							<select name="category_id" id="categorySelect" class="form-control" required>
								<option disabled selected value> -- выберите каталог -- </option>
								
							</select>
						</div>
						<div class="form-group">
							<label>Цена</label>
							<input type="text" name="price" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Цена акции</label>
							<input type="text" name="promoprice" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Начало акции</label>
							<input type="date" name="promostart" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Конец акции</label>
							<input type="date" name="promoend" class="form-control" required>
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
						<h4 class="modal-title">Изменить запись</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Название</label>
							<input type="text" name="title" id="updateTitle" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Каталог</label>
							<select name="catalog_id" id="catalogSelect2" class="form-control" required>
								<option disabled selected value> -- выберите каталог -- </option>
								<?php
								foreach ($catalogs as $value) {
								?>
								<option value="<?= $value[0] ?>"><?= $value[1] ?></option>
								<?php
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Категория</label>
							<select name="category_id" id="categorySelect2" class="form-control" required>
								<option disabled selected value> -- выберите каталог -- </option>
								
							</select>
						</div>
						<div class="form-group">
							<label>Цена</label>
							<input type="text" name="price" id="updatePrice" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Цена акции</label>
							<input type="text" name="promoprice" id="updatePromoprice" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Начало акции</label>
							<input type="date" name="promostart" id="updatePromostart" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Конец акции</label>
							<input type="date" name="promoend" id="updatePromoend" class="form-control" required>
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

		$('#catalogSelect').change(function () {
			var id = this.value;
			$.ajax({
				type: 'POST',
				url: 'query.php',
				data: {
					'CatalogId': id
				},
				success: function (data) {
					var $category = $('#categorySelect');
					$category.empty();
					$category.append(data);
				}
			});
		});

		$('#catalogSelect2').change(function () {
			var id = this.value;
			$.ajax({
				type: 'POST',
				url: 'query.php',
				data: {
					'CatalogId': id
				},
				success: function (data) {
					var $category = $('#categorySelect2');
					$category.empty();
					$category.append(data);
				}
			});
		});

		$(".edit").click(function() {
			document.getElementById("updateId").value = this.getAttribute('data-id');
			document.getElementById("updateTitle").value = this.getAttribute('data-title');
			document.getElementById("updatePrice").value = this.getAttribute('data-price');
			document.getElementById("updatePromoprice").value = this.getAttribute('data-promoprice');
			document.getElementById("updatePromostart").value = this.getAttribute('data-promostart');
			document.getElementById("updatePromoend").value = this.getAttribute('data-promoend');
			// this.getAttribute('data-catalogid')
			// this.getAttribute('data-categoryid')
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