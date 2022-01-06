<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootsrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <!-- Jquery -->
    <script src="libs/jquery-3.6.0/jquery-3.6.0/dist/jquery.min.js"></script>

    <!-- Custome CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Map | Web GIS Gianyar</title>
</head>

<body>
    <div id="container">
        <div id="mapdiv">
        </div>
        <div id="legenddiv">
            <div class="legend">
                <h2>Map Legend</h2>
                <div id="gianyar_administrasidesa_ar" class="legend_item" style="display:none;">
                    <p>Batas Desa Gianyar</p>
                    <img src="/geoserver/wms?REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&WIDTH=20&HEIGHT=20&LAYER=gianyar:administrasidesa_ar" alt="">
                </div>
            </div>
        </div>
    </div>    
  
    <script>
        var map = L.map('mapdiv').setView([-8.497, 115.284], 14);
        var osm = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiYXJpc3VyeWEiLCJhIjoiY2t4endqNjIwN3B5NTJub2N0bWs0bDcycyJ9.dvYtz2gCiW6TQtfwrHt1mQ'
        })
        osm.addTo(map);

        var gianyar = L.tileLayer.wms("/geoserver/wms?", {
            attribution : '&copy; geospansial',
            layers : "gianyar:administrasidesa_ar",
            format : "image/png",
            transparent: true
        }).setOpacity(0.3);

        var pariwisata_gianyar = L.tileLayer.wms("/geoserver/wms?", {
            attribution : '&copy; geospansial',
            layers : "gianyar:PariwisataGianyar",
            format : "image/png",
            transparent: true
        });

        var pariwisata = []
        <?php
             $connect = mysqli_connect('localhost', 'root', '', 'gianyar');
             if(!mysqli_connect_error()){
                $query=mysqli_query($connect, "SELECT * FROM Pariwisata");
                 while ($result=mysqli_fetch_array($query)){
                    ?>
                    var content = "<img src='assets/img/<?=$result['foto']?>' style='width:300px;'><h4><?=$result['judul']?></h4><p><?=$result['deskripsi']?></p>"
                    var d = L.marker([<?=$result['lng']?>, <?=$result['lat']?>]).bindPopup(content)
                    pariwisata.push(d)
                    <?php
                }
             }
        ?>

        var par = L.layerGroup(pariwisata)

        var basemap = {
            'OpenStreetMap':osm
        }

        var overlaymap = {
            'Batas Desa Gianyar':gianyar,
            'Pariwisata Gianyar':par
            
        }

        <?php
        $conn = mysqli_connect("localhost","root","")

        ?>
        L.control.layers(basemap, overlaymap).addTo(map)


        map.on('click', function(e){
            var pos = e.latlng;
            var pt = map.latLngToContainerPoint(pos);
            var w = map.getSize().x;
            var h = map.getSize().y;
            var bnd = map.getBounds();
            var west = bnd.getWest();
            var east = bnd.getEast();
            var north = bnd.getNorth();
            var south = bnd.getSouth();

            $.ajax({
                url: "/geoserver/wms",
                data:{
                    service : "WMS",
                    version : "1.1.1",
                    request : "GetFeatureInfo",
                    info_format : "application/json",
                    layers : "gianyar:administrasidesa_ar",
                    query_layers : "gianyar:administrasidesa_ar",
                    width : w,
                    height: h,
                    x : parseInt(pt.x),
                    y : parseInt(pt.y),
                    bbox : west+','+south+','+east+','+north
                },
                success : function(ajaxresult){
                    console.log(ajaxresult)
                    if(typeof(ajaxresult)!='undifined'){
                        var data = ajaxresult.features[0].properties;
                        var village = data['namobj'];
                        var district = data['wadmkc'];
                        var regency = data['wadmkk'];
                        var province = data['wadmpr'];
                    
                        console.log(village+','+district+','+regency+','+province)
                        var content = "<table class='table'><tr><th>Field</th><th>Value</th></tr><tr><td>Desa</td><td>"+village+"</td></tr><tr><td>Kecamatan</td><td>"+district+"</td></tr><tr><td>Kabupaten</td><td>"+regency+"</td></tr><tr><td>Provinsi</td><td>"+province+"</td></tr></table>"
                        L.popup().setLatLng(pos).setContent(content).openOn(map);
                    }
                   
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert('error');
                }

                
            });
        });



        map.on('layeradd', function(e){
            if(e.layer.options.layers){
                var layerId = e.layer.options.layers.replace(':','_');
                 $('#'+layerId).show()
            }
            
        });

        map.on('layerremove', function(e){
            if(e.layer.options.layers){
                var layerId = e.layer.options.layers.replace(':','_');
                 $('#'+layerId).hide()
            }            
        });


    </script>
</body>

</html>