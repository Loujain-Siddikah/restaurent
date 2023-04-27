<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@600&display=swap" rel="stylesheet">
    <title>menu</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
</head>

<body style="background: url('/images/background.jpg');-webkit-background-size: 100%; 
-moz-background-size: 100%; 
-o-background-size: 100%; 
background-size: 100%; 
-webkit-background-size: cover; 
-moz-background-size: cover; 
-o-background-size: cover; 
background-attachment: fixed;
background-position: center center;
background-repeat: no-repeat;">

    <div class="MyMenu container-fluid">
        @foreach ($items as $item)
            <div class="row pt-2 menuN">
                <div class="name col-2 col-sm-2 col-lg-2 col-md-2">
                    <div style="background-color: #5a5f64 ;border-style: solid; border-color:rgb(181, 183, 185);border-width:1px; border-radius: 10px;height: 32px; display:flex; justify-content:center; align-items:center; color:white; font-family: 'Roboto Slab', serif;font-size: 0.9em;">{{ $item->name }}</div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-8 col-xs-6">
                    <div class="card border-0 menuCard" style=" border-radius: 20px; background-image: linear-gradient(to right, #6b6e72, #5a5f64, #485057, #37424a, #26343d); border-color:#35393f">
                        <div class="card-body m-0 pt-2 pr-2 pb-0">
                            <div class="row justify-content-end">
                                <div class="col-8">
                                    <div class="description" style="background-image: linear-gradient(to right, #6b6e72, #5a5f64, #485057, #37424a, #26343d);border-style: solid; border-color:rgb(181, 183, 185);border-width:1px; border-radius: 10px; height: 25px; display:flex; align-items:center; justify-content:space-between; font-family: 'Roboto Slab', serif;">
                                        <span class="" style="color:rgb(255, 255, 255);padding-left:6px;font-size: 0.57em;">{{ $item->description }}
                                        </span>
                                        <span class="price" style="font-size: 0.66em;  color:#f9a201; padding-right:3px;">{{ $item->price }}<i class='fa fa-turkish-lira lira' style="color:#f9a201; font-size:9px"></i></span>                                      
                                    </div>
                                </div>                 
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-2 pb-1">
                                <img src="images/{{$item->img1}}" class="" style="width:32%; height:29%;object-fit: contain;" alt=""> <i class='fa fa-plus pt-1' style='color: white; font-size:24px'></i>
                                @if ($item->img2 == 'Layer 41.png')
                                    <img src="images/{{$item->img2 }}" class="pl-2" alt="" style="width:30%; height:29%; object-fit: contain;"> 
                                @else 
                                    <img src="images/{{$item->img2 }}" class="pl-2" alt="" style="width:20%; height:26%; object-fit: contain;">
                                        @endif
                                    <i class='fa fa-plus pt-1' style='color: white; font-size:24px'></i>
                                @if ($item->img3 == 'kola.png')
                                    <img src="images/{{$item->img3}}" class="" alt="" style="width:7%; height:9%; object-fit: contain;">
                                @else
                                <img src="images/{{$item->img3}}" class="" alt="" style="width:10%; height:24%; object-fit: contain;">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @foreach ($sections as $section)
            <div class="row pt-3">
                <div class="sectionNmae col-12 col-md-12">
                    <div style="background-color: #5a5f64;height: 32px; display:flex; justify-content:center; align-items:center; color:white; font-family: 'Roboto Slab', serif;font-size: 0.9em; ">{{ $section->name }}</div>
                </div>
            </div>
               
            <div class="row pt-3 justify-content-center" style="row-gap: 18px; column-gap:20px">
                @foreach ($section->items as $section_item)
                    @if ($section->name == 'İÇECEKLER')
                    <div class="İÇECEKLER col-3 col-md-2 col-lg-1 col-sm-2">
                    @else
                    <div class="col-md-3 col-5 col-lg-2 col-sm-3">
                    @endif
                        <div class="card" style="height:6.88rem; border-radius: 15px; background-image: linear-gradient(to right, #6b6e72, #5a5f64, #485057, #37424a, #26343d); border-color:#35393f; ">
                            <div class="card-body">
                                <div class="row justify-content-center" style="">
                                    @if ($section->name == 'İÇECEKLER' || $section->name == 'TATLILAR')
                                        <img src="images/{{$section_item->img}}" style="width:100%; height: 58px; object-fit: contain;" alt="">
                                    @else
                                        <img src="images/{{$section_item->img}}" style="width:100%; height: 60px; object-fit: contain;" alt="">
                                    @endif
                                </div>
                                <div class="row justify-content-center pt-2 sectionMenu">
                                    @if ($section->name == 'İÇECEKLER')
                                        <div class="description_İÇECEKLER" style="background-image: linear-gradient(to right, #6b6e72, #5a5f64, #485057, #37424a, #26343d);border-style: solid; border-color:rgb(181, 183, 185);border-width:1px; border-radius: 8px;height: 20px; display:flex; align-items:center;justify-content:center; font-family: 'Roboto Slab', serif;">
                                            <span style="font-size: 0.7em; color:#f9a201;">{{ $section_item->price }}<i class='fa fa-turkish-lira' style="color:#f9a201; font-size:10px"></i></span>
                                        </div>
                                    @else
                                        <div class="description2" style="background-image: linear-gradient(to right, #6b6e72, #5a5f64, #485057, #37424a, #26343d);border-style: solid; border-color:rgb(181, 183, 185);border-width:1px; border-radius: 8px;height: 20px; display:flex; align-items:center; padding-left:2px;font-family: 'Roboto Slab', serif;">
                                            <span style="color:rgb(255, 255, 255);padding-left:2px;font-size: 0.39em;">{{ $section_item->description }}
                                            </span>
                                            <span class="position-absolute top-5 end-0" style="font-size: 0.55em;  color:#f9a201; padding-right:9px;">{{ $section_item->price }}<i class='fa fa-turkish-lira' style="color:#f9a201; font-size:9px"></i></span> 
                                        </div> 
                                    @endif                             
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div> 
</body>
</html>  

