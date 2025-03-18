<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body>
    <div class="container mt-5">
        <h2>Admin Dashboard</h2>
        <a href="<?= site_url('CampaignController/createCampaign') ?>" class="btn btn-success mb-3">Create New Campaign</a>

        <a href="<?= site_url('logout') ?>" class="btn btn-success mb-3">logout</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Year</th>
                    <th>Month</th>
                    <th>Type</th>
                    <th>Geographic Scope</th>
                    <th>Created By</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($campaigns as $campaign): ?>
                    <tr>
                        <td><?= $campaign['id'] ?></td>
                        <td><?= $campaign['name'] ?></td>
                        <td><?= $campaign['year'] ?></td>
                        <td><?= $campaign['month'] ?></td>
                        <td><?= $campaign['campaign_type'] ?></td>
                        <td><?= $campaign['geographic_scope'] ?></td>
                        <td><?= $campaign['created_by'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
