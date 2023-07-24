<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCcSRitsDYHAWwZiHg_QgFuDHzYpXYsTgM&libraries=places&callback=initMap"defer></script>
         <script src = "https://maps.googleapis.com/maps/api/js"></script>
    <style>
        footer{
            margin-top: 30px;
        }
        .container{
            padding-top: 10px;
        }
        .ft__social__link  ul{
            display: flex;
            justify-content:space-between;
            margin-right: 80px;
            list-style: none;
        }
        .ft__social__link ul li a{
            color: white;
        }
        .social-icon{
            margin-top: 30px;
            display: flex;  
        }
        .social-icon li {
            list-style: none;
        }
        .social-icon li a{
            display: inline-block;
            width: 35px;
            height: 35px;
            background: #40ff40;
            display: flex;
            justify-content: center;
            align-items: center;   
            text-decoration: none;
            border-radius: 6px;
        }
        .social-icon li a:hover{
            background: #F30;
        }
        .social-icon li a .fa{
            color: #000;
            font-size: 50px;
        }
        .elementor-widget-container a{
            text-decoration: none;
        }
        /* .elementor-widget-container p a:hover{
            text-decoration: none;
            color: red;
        } */
    </style>
</head>
<body>
    <footer id="htc__footer" >
        <!-- Start Footer Widget -->
        <div class="footer__container bg__cat--1" style="background-color:#004812; height:auto;">
            <div class="container">
                <div class="row">
                    <!-- Start Single Footer Widget -->
                    <div class="col-md-4 col-sm-6 col-xs-12" >
                        <div class="footer">
                            <h2 class="title__line--2" style="color: white; margin-bottom: 30px;">Thông Tin Liên Lạc</h2>
							<div class="elementor-widget-container" style="color: white;">
				                <h5>Bệnh viện Tim Tâm Đức</h5>
                                <p><strong>Địa chỉ: </strong>4 Nguyễn Lương Bằng, phường Tân Phú, quận 7, TP.Hồ Chí Minh</p>
                                <p><strong>Điện thoại: </strong><span ><a style="color: white;" href="tel:02854110036">028 5411 0036</a></span>&nbsp;–&nbsp;<span ><a style="color: white;" href="tel:0903052432">0903 052 432</a></span></p>
                                <p><span style="color: white;"><strong>Email: </strong> <a style="color: white;" href="mailto:nhct1703@gmail.com" target="_blank" rel="noopener">hospital@tamduchearthospital.com</a></span></p>
                            </div>
					        
                            <div class="ft__social__link" >
                                <ul class="social-icon">
                                    <li><a href="https://twitter.com/"><i class="fa-brands fa-twitter"></i></a></li>
                                    <li><a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a></li>
                                    <li><a href="https://www.google.com.vn/"><i class="fa-brands fa-google"></i></a></li>
                                </ul>
                            </div>                                
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-6 col-xs-12 xmt-40 smt-40" >
                        <div class="footer">
                            <h2 class="title__line--2" style="color: white; margin-bottom: 30px;">Thời Gian Làm Việc</h2>
				            <div class="elementor-widget-container" style="color: white;">
                                <p><strong>Cấp cứu và nội trú 24/7 </strong></p>
                                <p><strong>Khám bệnh ngoại trú: </strong></p>
                                <p style="padding-left: 40px;">Thứ 2 – thứ 7: 7:00 tới 17:00</p>
                                <p><i>Lưu ý: Giờ làm việc của bệnh viện có thể cập nhật theo thời gian. Bệnh nhân có thể liên hệ trực tiếp bệnh viện để nắm rõ giờ làm việc.  </i></p>
						    </div>
                        </div>
                    </div>
                      

	
        <!-- GOOGLE MAP -->
    <script>
          //Khoi tao Map
         /* function initialize() {
            //Khai bao cac thuoc tinh
            var mapProp = {
              //Tam ban do, quy dinh boi kinh do va vi do
              center:new google.maps.LatLng(10.762622, 106.660172),
              //set default zoom cua ban do khi duoc load
              zoom:5,
              //Dinh nghia type
              mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            //Truyen tham so cho cac thuoc tinh Map cho the div chua Map
            var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
          }
          google.maps.event.addDomListener(window, 'load', initialize);*////
          let map, infoWindow;
          function initMap()
          {
            map = new google.maps.Map(document.getElementById("map"),{
                center: {lat: -34.397, lng:150.644},
                zoom: 15,
            });
            var marker = new google.maps.Marker({
            //    position: new google.maps.LatLng(10.822416518844406, 106.68681857831342),
               position: new google.maps.LatLng(10.7334512100728, 106.7179345994175),
               map: map,
            });
            infoWindow = new google.maps.InfoWindow();
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(
                    (position)=>{
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        infoWindow.setPosition(pos);
                        infoWindow.setContent("Bạn đang ở đây");
                        infoWindow.open(map);
                        map.setCenter(pos);
                    },
                    ()=>{
                        handleLocationError(true, infoWindow, map.getCenter());
                    }
                );
            }
            else
            {
                handleLocationError(false, infoWindow, map.getCenter());
            }
           
            marker.setMap(map);
            infoWindow.open(map);
          }
     
    </script>
                    <div class="col-md-4 col-sm-6 col-xs-12 xmt-40 smt-40" >
                        <div id="map" style="width:350px; height:280px; margin-top: 10px; ">
                            <input type="text" id="address" />
                            <button id="detail">Detail</button>
                            <div id="result"></div>
                        </div>
                    </div>
     <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1165.08464638682!2d106.68702369382301!3d10.821870356331692!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528e5496d03cf%3A0xa5b8e7395ec636b9!2zMTIgTmd1eeG7hW4gVsSDbiBC4bqjbywgUGjGsOG7nW5nIDQsIEjhu5MgQ2jDrSBNaW5oLCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmg!5e0!3m2!1svi!2s!4v1607052207531!5m2!1svi!2s" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->
    
                    <div class="container-fluid" >
                       
	                    <p class="text-center" style="color:white;  font-size: small;">TRƯỜNG ĐẠI HỌC CÔNG NGHIỆP THÀNH PHỐ HỒ CHÍ MINH - KHOA CÔNG NGHỆ THÔNG TIN </p>
                    </div>
                </div>
            </div>
        </div>
            <!-- End Footer Widget -->
    </footer>

 
</body>
</html>