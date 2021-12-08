<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $img = isset($_POST['img']) ? $_POST['img'] : '';
    $capt = isset($_POST['capt']) ? $_POST['capt'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO projects VALUES (?, ?, ?)');
    $stmt->execute([$id, $img, $capt]);
    // Output message
    $msg = 'Created Successfully!';
    
} 
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create Projects</h2>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <label for="id">ID</label>
        <label for="nama">Gambar</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="img" id="img">
        <label for="text">Keterangan</label>
        <input type="text" name="capt" id="capt">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>