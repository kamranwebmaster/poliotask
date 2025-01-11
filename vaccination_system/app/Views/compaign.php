<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: You can add custom CSS styles here -->
    <style>
        .container {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mb-4">Admin Dashboard</h1>
        <a href="<?= site_url('admin/create'); ?>" class="btn btn-primary mb-4">Create New Campaign</a>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Campaign Name</th>
                    <th>Year</th>
                    <th>Month</th>
                    <th>Geographic Scope</th>
                    <th>Target Population</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($campaigns as $campaign): ?>
                    <tr>
                        <td><?= $campaign['campaign_name']; ?></td>
                        <td><?= $campaign['year']; ?></td>
                        <td><?= $campaign['month']; ?></td>
                        <td><?= $campaign['geographic_scope']; ?></td>
                        <td><?= $campaign['target_population']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (Optional, for additional functionality like modals, tooltips) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
