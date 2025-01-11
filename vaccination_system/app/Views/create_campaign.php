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
        <h2>Create New Campaign</h2>
        <form method="POST" action="<?= site_url('admin/store') ?>">
            <div class="form-group">
                <label for="name">Campaign Name</label>
                <input type="text" class="form-control" name="campaign_name" id="campaign_name" required>
            </div>
            <div class="form-group">
                <label for="year">Year</label>
                <input type="number" class="form-control" name="year" id="year" required>
            </div>
            <div class="form-group">
                <label for="month">Month</label>
                <input type="text" class="form-control" name="month" id="month" required>
            </div>
            <div class="form-group">
                <label for="campaign_type">Campaign Type</label>
                <select class="form-control" name="campaign_type" id="campaign_type">
                    <option value="Intra-Campaign">Intra-Campaign</option>
                    <option value="Catch-Up">Catch-Up</option>
                </select>
            </div>
            <div class="form-group">
                <label for="geographic_scope">Geographic Scope</label>
                <input type="text" class="form-control" name="geographic_scope" id="geographic_scope" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
