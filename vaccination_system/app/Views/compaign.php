<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>  Polio Vaccine | Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: You can add custom CSS styles here -->
    <style>
        .container {
            margin-top: 30px;
        }
        canvas {
            width: 400px !important;
            height: 350px !important;
        }
    </style>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="mb-4"> Polio Vaccine | Admin Dashboard</h1>
        <a href="<?= site_url('admin/create'); ?>" class="btn btn-primary mb-4">Create New Campaign</a>
        <a href="<?= site_url('logout') ?>" class="btn btn-success mb-3">logout</a>

        <div class="row">


            <div class="col-md-12  ">

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
                                <td><?= $campaign['prov'] . ' : ' . $campaign['district']; ?></td>
                                <td><?= $campaign['target_p']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>



            </div>
            <div class="col-md-6 ">





                <h2>Overall Vaccination Coverage</h2>
                <canvas id="overallCoverageChart"  ></canvas>



                <h2>Coverage Breakdown by Geographical Location</h2>
                <canvas id="geoCoverageChart"  ></canvas>


                <script>
                    // Data from PHP
                    var coverageData = <?= json_encode($coveragebyloc) ?>;

                    // Extract labels and data
                    var labels = [];
                    var coveragePercentage = [];

                    coverageData.forEach(function (item) {
                        let total = parseInt(item.target_population);
                        let vaccinated = parseInt(item.vaccinated);
                        let percentage = (vaccinated / total) * 100;

                        labels.push(`${item.prov} - ${item.district}`);
                        coveragePercentage.push(percentage.toFixed(2));
                    });

                    // Overall Coverage Chart
                    var ctx1 = document.getElementById("overallCoverageChart").getContext("2d");
                    new Chart(ctx1, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Vaccination Coverage (%)",
                                data: coveragePercentage,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: { beginAtZero: true, max: 100 }
                            }
                        }
                    });

                    // Coverage Breakdown Chart
                    var ctx2 = document.getElementById("geoCoverageChart").getContext("2d");
                    new Chart(ctx2, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Vaccination Coverage (%)",
                                data: coveragePercentage,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.6)',
                                    'rgba(54, 162, 235, 0.6)',
                                    'rgba(255, 206, 86, 0.6)',
                                    'rgba(75, 192, 192, 0.6)',
                                    'rgba(153, 102, 255, 0.6)',
                                    'rgba(255, 159, 64, 0.6)'
                                ]
                            }]
                        }
                    });
                </script>


               
            </div>

            <div class="col-md-6 ">

<h2>Missing Coverage</h2>


<canvas id="coverageChart" width="400" height="200"></canvas>

<script>
    // Sample data fetched from backend (use the PHP output here)
    var data = <?php echo json_encode($coverageMissing); ?>;

    // Process data for chart
    var labels = data.map(function (item) { return item.union; });
    var vaccinatedData = data.map(function (item) { return item.vaccinated; });
    var missedData = data.map(function (item) { return item.missed_children; });
    var coveredMissedData = data.map(function (item) { return item.covered_missed_children; });

    var ctx = document.getElementById('coverageChart').getContext('2d');
    var coverageChart = new Chart(ctx, {
        type: 'bar',  // Bar chart type
        data: {
            labels: labels,  // Union names
            datasets: [{
                label: 'Vaccinated Children',
                data: vaccinatedData,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },
            {
                label: 'Missed Children',
                data: missedData,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                label: 'Covered Missed Children',
                data: coveredMissedData,
                backgroundColor: 'rgba(153, 102, 255, 0.5)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
               
<hr>


                <h1 class="mb-4">Coverage area Map</h1>



                <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

                <div id="map" style="height: 600px; width: 100%;"></div>
                <script>
// Initialize Leaflet map
var map = L.map('map').setView([30.3753, 69.3451], 6); // Example coordinates for Pakistan

// Add tile layer (OpenStreetMap)
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Sample data fetched from backend (use the PHP output here)
var data = <?php echo json_encode($coverageMissing); ?>;

// Function to generate the coverage percentage and legends
function getCoveragePercentage(item) {
    return (item.covered_missed_children / item.missed_children) * 100;
}

// Loop through the data and create markers or polygons
data.forEach(function(item) {
    var coveragePercentage = getCoveragePercentage(item);

    // You can replace these coordinates with real lat/lon for each union or district
    var lat = 30 + Math.random() * 5;  // Random lat for example
    var lon = 70 + Math.random() * 5;  // Random lon for example

    // Create marker
    var marker = L.marker([lat, lon]).addTo(map);

    // Bind the popup on hover
    marker.on('mouseover', function (e) {
        var legendHtml = `
            <div class="legend">
                <b>Union: ${item.union}</b><br>
                Vaccinated: ${item.vaccinated}<br>
                Missed Children: ${item.missed_children}<br>
                Covered Missed Children: ${item.covered_missed_children}<br>
                Coverage Status: ${coveragePercentage.toFixed(2)}%<br>
            </div>
        `;
        
        // Show the popup with the legend
        marker.bindPopup(legendHtml).openPopup();
    });

    // Optionally: Close the popup on mouseout
    marker.on('mouseout', function (e) {
        marker.closePopup();
    });
});

</script>

            </div>




        </div>

    </div>
    </div>

</body>

</html>