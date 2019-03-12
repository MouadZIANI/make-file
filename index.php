<?php
	if (isset($_POST['submit']) && !empty($_POST['file-name'])) {
		$webRoot = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$fileName = $_POST['file-name'];
		$content = $_POST['content'];
		if(!file_exists($fileName)) {
			touch($fileName);
			$message = "The file <a onClick='copy(this)' href='$webRoot" . "$fileName'>$webRoot" . "$fileName</a> updated succesfully";
		} elseif(!empty($_POST['content'])) {
			$message = "The file <a onClick='copy(this)' href='$webRoot" . "$fileName'>$webRoot" . "$fileName</a> created succesfully";
		}
		$oldContent = file_get_contents($fileName);
		$oldContent .= $content;
		file_put_contents($fileName, $oldContent);
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Make directory</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
	<section class="content" style="margin-top: 90px">
        <div id="container" class="container">
            <div class="row">
            	<div class="col-md-6 offset-sm-3">
					<?php if (isset($message) && !empty($message)): ?>
						<div class="alert alert-success"><?= $message ?></div>	
						<br>
					<?php endif ?>
					<form method="post">
						<div class="form-group">
							<label for="">File Name</label>
							<input type="text" name="file-name" class="form-control" placeholder="File name">
						</div>
						<div class="form-group">
							<label for="">Content</label>
							<textarea name="content" class="form-control" cols="30" rows="10" placeholder="Content"></textarea>
						</div>
						<button name="submit" class="btn btn-primary">Create / Update file</button>
					</form>
				</div>
            </div>
        </div>
	</section>
</body>
</html>
