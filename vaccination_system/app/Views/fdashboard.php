<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Campaign</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5"> 
    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>
  
    <h1>Field Worker Dashboard</h1>
    <form action="<?= site_url('field-worker/submit'); ?>" method="post">
        <label for="campaign_id">Campaign:</label>
        <select name="campaign_id" required>
            <?php foreach ($campaigns as $campaign): ?>
                <option value="<?= $campaign['id']; ?>"><?= $campaign['campaign_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="coverage">Vaccination Coverage:</label>
        <input type="number" name="coverage" required>
        <button type="submit">Submit Data</button>
    </form>
</body>
</html>
