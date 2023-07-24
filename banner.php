 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='img/icon/tittle.jpg' />
    <link rel='shortcut icon' href='img/icon/tittle.jpg' />
    <title>Tam Duc Heart Hospital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
   
        <div class="banner" style=" height: 100%; width: 100%;"> 
            <img id="aaa" style="width:100%; height: 80%" src="img/banner/banner0.jpg"/>
        </div>
</body>
<script>
     var image=document.getElementById("aaa");
     var img_array=["img/banner/banner0.jpg","img/banner/banner1.png","img/banner/banner-dkikhambenh.png","img/banner/banner7.png","img/banner/banner8.png","img/banner/banner5.gif"];
     var index=0;
     function slide()
 {
     image.setAttribute("src",img_array[index]);
     index++;
     if(index>=img_array.length)
     {
    index=0;
     }
 }
 setInterval("slide()",4000);
</script>
</html> 

