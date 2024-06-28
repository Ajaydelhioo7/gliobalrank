<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link href="./css/main.css" rel="stylesheet">
    </head>

    <body>
        <header>
            <!-- Nav tabs -->
             <li><a href="./dashboard.php">Dashboard</a></li>
            <ul
                class="nav nav-tabs"
                id="navId"
                role="tablist"
            >
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle text-light"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="true"
                        aria-expanded="false"
                        >History</a
                    >
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="./history.php">What is History?</a>
                        <a class="dropdown-item" href="./stoneage.php">Stone Age</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="./chalcolothic.php">Chalcolithic Age</a>
                    </div>
                </li>
                
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab1Id" role="tabpanel">
                    
                </div>
                <div class="tab-pane fade" id="tab2Id" role="tabpanel"></div>
                <div class="tab-pane fade" id="tab3Id" role="tabpanel"></div>
                <div class="tab-pane fade" id="tab4Id" role="tabpanel"></div>
                <div class="tab-pane fade" id="tab5Id" role="tabpanel"></div>
            </div>
            
            <!-- (Optional) - Place this js code after initializing bootstrap.min.js or bootstrap.bundle.min.js -->
            <script>
                var triggerEl = document.querySelector("#navId a");
                bootstrap.Tab.getInstance(triggerEl).show(); // Select tab by name
            </script>
            
        </header>
        <main></main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
