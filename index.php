<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="Assets/Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="Assets/Custom/Css/Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="Assets/Bootstrap/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main">
        <div class="container-fluid" style="margin-top:50px; min-height:100vh; background:white">
            <div class="position-fixed topnavbar bg-primary">
                <div class="navlogo">
                    <img src="img/mainlogo.png" alt="">
                </div>
                <div class="content-right align-middle">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                </div>
            </div>
            
            <div class="d-block w-100">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" style='top:10px'>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/Banners/1.png" class="d-block w-100 rounded-3" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="img/Banners/2.png" class="d-block w-100 rounded-3" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="img/Banners/3.png" class="d-block w-100 rounded-3" alt="...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 shadow-sm bg-body rounded-pill p-2 mt-3">
                <i class="fa fa-bell" aria-hidden="true" style="color:#4781ff"></i>
                <p class="d-inline p-0 ms-2 m-0 overflow-hidden" style="font-size:12px; width:60%; word-wrap: break-word">ksgdkjhkjskdhgjkhksjhdgj</p>
                <button class="btn btn-primary text-white rounded-pill float-end p-1 ps-3 pe-3" style="font-size:12px;">Detail</button>
            </div>

            <h5 class="border-start border-5 ps-2 mt-3" >Lottery Games</h5>
            <div class="mt-3 rounded-3 gamelist shadow-sm">
                <div class="title">
                    <h2 class="">Win GO</h2>
                    <p class="mb-0">Guees Number</p>
                    <p class="mb-0">Green/Red/Purple to Win</p>
                </div>
                <div class="image">
                    <img src="img/wingologo.png" class="" alt="" srcset="">
                </div>
            </div>

            <h5 class="border-start border-5 ps-2 mt-3" >Recent Winners</h5>
            <div class="recentWinner">
                <div class="recentwinnerlist d-flex p-1 border rounded-3">
                    <img class="ms-2" src="https://cdn-icons-png.flaticon.com/512/219/219969.png" alt="" srcset="">
                    <strong>Roh***t</strong>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
</script>
</html>