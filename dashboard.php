<?php 
session_start();
if (isset($_SESSION['ID']) && isset($_SESSION['user_name'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>GC-MedMaRS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />    
    <link rel="stylesheet" href="css/main.css"/>
    <script src="https://kit.fontawesome.com/a7da5612c9.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
</head>
<body>
    <div class="container">
    <nav>
        <ul>
        <li><a href="dashboard.php" class="logo">
            <img src="assets/logo.png" alt="logo">
            <span class="nav-item">GC-MedMaRS</span>
        </a></li>
        <li><a href="home.php">
            <i class="fa-solid fa-building-user"></i>
            <span class="nav-item">Departments</span>
        </a></li>
        <li><a href="appointment.php">
            <i class="fa-solid fa-calendar-check"></i>
            <span class="nav-item">Appointment List</span>
        </a></li>
        <li><a href="user.php">
            <i class="fa-solid fa-user"></i>
            <span class="nav-item">User Profile</span>
        </a></li>
        <li><a href="logout.php" class="logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span class="nav-item">Log out</span>
        </a></li>
        </ul>
    </nav>
    
    
    <section class="main">
        <div class="top">
            <h1>GC-MedMaRS</h1>
            <div class="date-time">
                <i class="fa fa-calendar"></i>
                <?php
                    date_default_timezone_set('Asia/Manila'); 
                    echo date('l, M d, Y, h:i A'); 
                ?>
            </div>
        </div>

        <section class="dashboard">
            <div class="card red">
                <h3>CAHS</h3>
                <p>College of Allied Health Sciences</p>
                <button type="button" class="btn-select" data-value="cahs_list">View</button>
            </div>
            <div class="card yellow">
                <h3>CBA</h3>
                <p>College of Business and Accountancy.</p>
                <button type="button" class="btn-select" data-value="cba_list">View</button>
            </div>
            <div class="card blue">
                <h3>CEAS</h3>
                <p>College of Education, Arts, and Sciences</p>
                <button type="button" class="btn-select" data-value="ceas_list">View</button>
            </div>
            <div class="card pink">
                <h3>CHTM</h3>
                <p>College of Hospitality and Tourism Management</p>
                <button type="button" class="btn-select" data-value="chtm_list">View</button>
            </div>
            <div class="card orange">
                <h3>CCS</h3>
                <p>College of Computer Studies</p>
                <button type="button" class="btn-select" data-value="patient">View</button>
            </div>
        </section>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mt-4">
                        <div class="card-header">Proportion of Students by Department</div>
                        <div class="card-body">
                            <div class="chart-container pie-chart">
                                <canvas id="pie_chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                    <iframe width="545" height="263" src="https://www.youtube.com/embed/Jf_nnD2We1g?si=awZH_Sbp4S0bNIcS&controls=0&start=5" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            </div>

    </section>
    </div>
</body>
<script>
    $(document).ready(function () {
    $('.btn-select').click(function () {
        var selectedDepartment = $(this).data('value');
        console.log("Selected Department:", selectedDepartment); 

        $.ajax({
            url: "data.php",
            method: "POST",
            data: {
                action: 'fetch'
            },
            dataType: "JSON",
            success: function (data) {
                console.log("Fetched data:", data); 

                var labels = [];
                var datasets = [];
                var colors = [];

                if (Array.isArray(data)) {
                    data.forEach(function (item) {
                        console.log("Processing item:", item); 
                        if (item.department && item.total !== undefined) {
                            labels.push(item.department);
                            datasets.push(item.total);

                            if (selectedDepartment === item.department.toLowerCase() + "_list" ||
                                (item.department === 'CCS' && selectedDepartment === 'patient')) {
                                colors.push('#' + Math.floor(Math.random() * 16777215).toString(16));
                            } else {
                                colors.push('#d3d3d3'); 
                            }
                        } else {
                            console.warn("Invalid item format:", item); 
                        }
                    });
                } else {
                    console.error("Invalid data structure:", data);
                    return;
                }

                var chart_data = {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Total Rows',
                            backgroundColor: colors,
                            data: datasets
                        }
                    ]
                };

                var options = {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true 
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true 
                        }
                    }
                };

                $('#pie_chart').replaceWith('<canvas id="pie_chart"></canvas>');

                new Chart($('#pie_chart')[0].getContext('2d'), {
                    type: 'pie',
                    data: chart_data,
                    options: options
                });
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
    });
});

</script>

</html>

<?php 
} else {
    header("Location: login.php");
    exit();
}
?>