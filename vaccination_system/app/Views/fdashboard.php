<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polio Vaccine | Feild Worker Campaign</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<style>
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
  
    <h1>Polio Vaccine | Field Worker Checklist</h1>
    <form action="<?= site_url('field-worker/submit'); ?>" method="post">
        <!-- <label for="campaign_id">Campaign:</label>
        <select name="campaign_id" required>
            <?php foreach ($campaigns as $campaign): ?>
                <option value="<?= $campaign['id']; ?>"><?= $campaign['campaign_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="coverage">Vaccination Coverage:</label>
        <input type="number" name="coverage" required>
        <button type="submit">Submit Data</button> -->

        <div class="container">
    <div class="row">
        <div class="col-12 header">Intra Campaign Days Coverage Data</div>
    </div>
     

    <div class="row">
        <div class="col-md-4 bordered font-weight-bold" rowspan="2">Select Campaign</div>
        <div class="col-md-4 bordered">Year:
        <select class="form-control" name="campaign_year"
                                id="campaign_year">
                                <option value="NID">NID</option> 
                            </select>
        <br>
        Campaign Activity: 
        <select class="form-control" name="campaign_Activity"
                                id="campaign_Activity">
                                <option value="NID">NID</option> 
                            </select>
        </div>
        <div class="col-md-4 bordered"></div>
    </div> 

    <div class="row">
        <div class="col-md-4 bordered font-weight-bold" rowspan="4">Geographical Information</div>
        <div class="col-md-4 bordered">Province:
                            <select class="form-control" name="Province" id="Province">
                            </select>
                        </div>
    </div>
    <div class="row">
    <div class="col-md-4 bordered"></div>

        <div class="col-md-4 bordered">Select District:
        <select class="form-control" name="Province" id="Province">
        </select>
        </div>
    </div>
    <div class="row">
    <div class="col-md-4 bordered"></div>

        <div class="col-md-4 bordered">Select Tehsil:
        <select class="form-control" name="Province" id="Province">
        </select>
        </div>
     </div>
    <div class="row">
    <div class="col-md-4 bordered"></div>

        <div class="col-md-4 bordered">Union Council:
        <select class="form-control" name="Province" id="Province">
        </select>
        </div>
     </div>

    <div class="row">
        
        <div class="col-md-4 bordered font-weight-bold" rowspan="2">Campaign Day Information</div>
        <div class="col-md-4 bordered"></div>
        <div class="col-md-4 bordered"></div>

     </div>
    <div class="row"> <div class="col-md-4 bordered">Campaign Day:</div>
        <div class="col-md-4 bordered">Vaccination Date:</div>
        <div class="col-md-4 bordered">System Generated Date</div>
    </div>

    <div class="row">
        <div class="col-md-4 bordered font-weight-bold" rowspan="3">Vaccination Information (#)</div>
        <div class="col-md-4 bordered"></div>
        <div class="col-md-4 bordered"></div>

    </div>
    <div class="row">
                <div class="col-md-4 bordered">Number of houses visited:</div>

        <div class="col-md-4 bordered">0-11 months age children vaccinated-First Visit:</div>
        <div class="col-md-4 bordered"></div>
    </div>
    <div class="row">
    <div class="col-md-4 bordered">Number of houses visited:</div>

        <div class="col-md-4 bordered">12-59 months age children vaccinated-First Visit:</div>
        <div class="col-md-4 bordered"></div>
    </div>

    <div class="row">
        <div class="col-md-4 bordered font-weight-bold" rowspan="4">Children Recorded as Unvaccinated (#)</div>
        <div class="col-md-4 bordered"></div>
        <div class="col-md-4 bordered"></div>

    </div>
    <div class="row">
    <div class="col-md-3 bordered">0-11 months Children recorded as Not Available</div>

        <div class="col-md-3 bordered">12-59 months age children recorded as Not Available</div>
       
        <div class="col-md-3 bordered">0-11 months children recorded as Refusals:</div>
          
        <div class="col-md-3 bordered">12-59 months children recorded as Refusals:</div>
     </div>

    <div class="row">
        <div class="col-md-4 bordered font-weight-bold" rowspan="5">Same day revisit coverage of Unvaccinated (Not Available and Refusals Children) (#)</div>
        <div class="col-md-4 bordered"></div>
        <div class="col-md-4 bordered"></div>

    </div>
    <div class="row">
    <div class="col-md-3 bordered">0-11 months covered NA on same day:</div>

        <div class="col-md-3 bordered">12-59 months covered NA on same day:</div>
    
        <div class="col-md-3 bordered">0-11 months covered refusals on same day:</div>
      
         
        <div class="col-md-3 bordered">12-59 months covered refusals on same day:</div>
     </div>

</div>
<button type="submit" class="btn btn-primary">Submit</button>

    </form>
</body>
</html>
