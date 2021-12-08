<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $img = isset($_POST['img']) ? $_POST['img'] : '';
        $capt = isset($_POST['capt']) ? $_POST['capt'] : '';
    
        // Update the record
        $stmt = $pdo->prepare('UPDATE works SET id = ?, img = ?, capt = ? WHERE id = ?');
        $stmt->execute([$id, $img, $capt, $_GET['id']]);
        $msg = 'Updated Successfully!';
        header('Location: read.php');
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM works WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Works doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Works #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
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