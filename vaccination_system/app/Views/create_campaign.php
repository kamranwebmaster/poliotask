<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Campaign</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body> 

   <style>
            body {
                margin-left: 0.7in;
                margin-right: 0.7in;
                margin-top: 0.75in;
                margin-bottom: 0.75in;
            }

            .bordered {
                border: 1px solid #ddd;
                padding: 10px;
                background-color: #f8f9fa;
            }

            .header {
                font-weight: bold;
                text-align: center;
                background-color: #007bff;
                color: white;
                padding: 10px;
            }
        </style>
        
        <div class="container mt-5">
            <h2>Create New Campaign</h2>

            <form method="POST" action="<?= site_url('admin/store') ?>">

                <div class="container">
                    <div class="row">
                        <div class="col-12 header">Campaign Activity Creation</div>
                    </div>




                    <div class="row">
                        <div class="col-md-4 bordered font-weight-bold" rowspan="8">  Campaign Activity</div>
                        <div class="col-md-4 bordered"><input type="text" class="form-control" name="campaign_name"
                                id="campaign_name" required="">
                        </div>
                        <div class="col-md-4 bordered"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 bordered">Select Year</div>
                        <div class="col-md-4 bordered"><input type="number" class="form-control" name="year" id="year"
                                required=""></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 bordered">Select Month</div>
                        <div class="col-md-4 bordered"><input type="text" class="form-control" name="month" id="month"
                                required="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 bordered">Start Date</div>
                        <div class="col-md-4 bordered" rowspan="2"><input type="text" class="form-control" name="sd"
                                id="sd" required=""></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 bordered">End Date</div>
                        <div class="col-md-4 bordered" rowspan="2"><input type="text" class="form-control" name="ed"
                                id="ed" required=""></div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 bordered" rowspan="3">Campaign Type</div>
                        <div class="col-md-4 bordered"><select class="form-control" name="campaign_type"
                                id="campaign_type">
                                <option value="NID">NID</option>
                                <option value="SNID">SNID</option>
                                <option value="OBR">OBR</option>
                            </select></div>
                    </div>





                    <div class="row">
                        <div class="col-md-4 bordered" rowspan="4">Campaign Geographic Scope</div>
                        <div class="col-md-4 bordered">Province:
                            <select class="form-control" name="Province" id="Province">
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4 bordered">
                        </div>
                        <div class="col-md-4 bordered">District:
                            <select class="form-control" name="District" id="District">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 bordered"> </div>
                        <div class="col-md-4 bordered">Tehsil:
                            <select class="form-control" name="Tehsil" id="Tehsil">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 bordered">
                        </div>
                        <div class="col-md-4 bordered">Union Council:
                            <select class="form-control" name="Union" id="Union">
                            </select>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
</body>

</html>