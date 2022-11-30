import './bootstrap';
import jQuery, { css } from 'jquery';
import Alpine from 'alpinejs';

window.$ = jQuery;
window.Alpine = Alpine;

import tt from '@tomtom-international/web-sdk-maps';
import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';
import { set } from 'lodash';



Alpine.start();

var map = null;
var api = "GEJuHmudX7SntHEluTxaRHqQFHnCwSCU";
var csrf = $('meta[name="csrf-token"]')[0].content;
var mapView = $('#map')[0].attributes.defaultView.value;
mapView = mapView.split(',');

var z = (mapView != "") ? mapView[2].replace("x","") : 0;
var c = (mapView != "") ? [mapView[1],mapView[0]] : [0,0];
var l = navigator.languages && navigator.languages.length ? navigator.languages[0] : navigator.language;

if($("#searchbox").length > 0){
    // Search box
    var ttSearchBox = new SearchBox(services, {
        idleTimePress: 100,
        minNumberOfCharacters: 0,
        searchOptions: {
            key: api,
            language: 'en-GB'
        },
        autocompleteOptions: {
            key: api,
            language: 'en-GB'
        },
        noResultsMessage: 'No results found.',
        showSearchButton: false,
    });
    var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
    ttSearchBox.on('tomtom.searchbox.resultselected', handleResultSelection);
    ttSearchBox.on('tomtom.searchbox.resultfocused', handleResultSelection);  
    $("#searchbox").prepend(searchBoxHTML); 
}

if($("#map").length > 0){ 
    var geoJson = {};
    var markersOnTheMap = {};
    var searchMarker;
    var eventListenersAdded = false; 
    //bool map getdata from db 
    var dataFromDb = ($('#map')[0].attributes.getdata.value == 'true') ? true : false;

    if(dataFromDb){
        // Event from database
        var events = function () {
            var tmp;
            $.ajax({ type:'POST', url:'/getEvents', async: false, global: false, headers: { 'X-CSRF-TOKEN': csrf }, dataType: 'json',
                success:function(data) { tmp = data; }
            });
            return tmp;
        }
        var all_events = events();
        var points = [];
        if(all_events != null){ all_events.forEach(element => { points.push({ coordinates: [element.longitude, element.latitude], properties: { id: element.id, uuid: element.uuid, cover: element.cover }}) }); }

        /*Get Data here*/
        geoJson = {
            type: 'FeatureCollection',
            features: points.map(function(point) {
                return {
                    type: 'Feature',
                    geometry: {
                        type: 'Point',
                        coordinates: point.coordinates
                    },
                    properties: point.properties
                };
            })
        };
    }

    map = tt.map({
        key: api,
        container: 'map',
        language: l,
        center: c,
        zoom: z,
        scrollZoom: true,
        boxZoom: false,
        dragRotate: false,
        touchZoomRotate: true,
        pitchWithRotate: false,
        doubleClickZoom: false,
        maxZoom: 18,
        snapZoom: 1,
    });

    map.TouchZoomRotateHandler.disableRotation();

    if($('#map')[0].attributes.setLatLng && dataFromDb == false)
    {
        var data = $('#map')[0].attributes.setLatLng.value.split(',');
        var LatLng = new tt.LngLat(data[1], data[0]);
        
        new tt.Marker().setLngLat(LatLng).addTo(map);
        map.setZoom(15);
        map.setCenter(LatLng);
    }

    map.on('load', function() {
        if(dataFromDb){
            map.addSource('point-source', {
                type: 'geojson',
                data: geoJson,
                cluster: true,
                clusterMaxZoom: 14,
                clusterRadius: 50
            });
            map.addLayer({
                id: 'clusters',
                type: 'circle',
                source: 'point-source',
                filter: ['has', 'point_count'],
                paint: {
                    'circle-color': [
                        'step',
                        ['get', 'point_count'],
                        '#457b9d',
                        10,
                        '#1d3557'
                    ],
                    'circle-radius': [
                        'step',
                        ['get', 'point_count'],
                        15,
                        4,
                        20,
                        7,
                        25
                    ],
                    'circle-stroke-width': 1,
                    'circle-stroke-color': 'white',
                    'circle-stroke-opacity': 1
                }
            });

            map.addLayer({
                id: 'cluster-count',
                type: 'symbol',
                source: 'point-source',
                filter: ['has', 'point_count'],
                layout: {
                    'text-field': '{point_count_abbreviated}',
                    'text-size': 16
                },
                paint: {
                    'text-color': 'white'
                }
            });

            map.on('data', function(e) {
                if (e.sourceId !== 'point-source' || !map.getSource('point-source').loaded()) {
                    return;
                }
                refreshMarkers();
                if (!eventListenersAdded) {
                    map.on('move', refreshMarkers);
                    map.on('moveend', refreshMarkers);
                    eventListenersAdded = true;
                }
            });

            map.on('click', 'clusters', function(e) {
                var features = map.queryRenderedFeatures(e.point, { layers: ['clusters'] });
                var clusterId = features[0].properties.cluster_id;
                map.getSource('point-source').getClusterExpansionZoom(clusterId, function(err, zoom) {
                    if (err) {
                        return;
                    }
                    map.easeTo({
                        center: features[0].geometry.coordinates,
                        zoom: zoom + 0.5
                    });
                });
            });

            map.on('mouseenter', 'clusters', function() {
                map.getCanvas().style.cursor = 'pointer';
            });
            map.on('mouseleave', 'clusters', function() {
                map.getCanvas().style.cursor = '';
            }); 
        }

        map.on("zoom", () => { $("#mapzoom").html(getMapInfo()); });
        map.on("move", () => { $("#mapzoom").html(getMapInfo()); });   
    });
}

setTimeout(() =>{
    $("#spinner").removeClass('opacity-100');
    $("#spinner").addClass('opacity-0');
    setTimeout(() => { $("#spinner").remove() }, 600);
}, 2000)

$('#openNeweventForm').on("click", ()=>{
    $('#rightmenu').hide();
    $("#NeweventForm").show();
})

function getMapInfo() {
    var lat = getCenter().lat;
    var lng = getCenter().lng;
    var zoom = getZoom();

    return lat.toFixed(3) + ", " + lng.toFixed(3) + ", " + zoom.toFixed(1) + "x";
}

function getCenter(){ return map.getCenter(); } 
function getZoom() { return map.getZoom(); }

function refreshMarkers(){        
    Object.keys(markersOnTheMap).forEach(function(id) {
        markersOnTheMap[id].remove();
        delete markersOnTheMap[id];
    });

    map.querySourceFeatures('point-source').forEach(function(feature) {
        if (feature.properties && !feature.properties.cluster) {
            var id = parseInt(feature.properties.id, 10);
            if (!markersOnTheMap[id]) {
                markersOnTheMap[id] = addEventMarker(feature.geometry.coordinates,feature.properties.cover, feature.properties.uuid);
            }
        }
    });
}

function addEventMarker(latlng, cover, uuid){
    let markerElement = document.createElement('div');  
    
    let zoom = map.getZoom()   

    markerElement.className = 'block bg-center fit-cover bg-[length:100px] border-2 border-black rounded-md cursor-pointer';
    markerElement.style.backgroundImage = "url("+cover+")"
    markerElement.id = uuid;   

    if(zoom >= 16){
        markerElement.className += " w-10 h-10";
    }
    else if(zoom >= 14){
        markerElement.className += " w-9 h-9";
    }
    else if(zoom >= 12){
        markerElement.className += " w-8 h-8";
    }
    else if(zoom >= 10){
        markerElement.className += " w-7 h-7";
    }
    else if(zoom >= 0){
        markerElement.className += " w-6 h-6";
    }

    markerElement.addEventListener('click', openBottomModal, uuid)

    return new tt.Marker({element: markerElement, anchor: 'center'})
        .setLngLat(latlng)
        .addTo(map)
}

function openBottomModal(marker){
    let uuid = marker.target.id;
    var allevents = function () {
        var tmp;
        $.ajax({
            type:'POST',
            url:'/getEvents/'+uuid,
            async: false,
            global: false,
            headers: {
                'X-CSRF-TOKEN': csrf
            },
            'dataType': 'json',
            success:function(data) {
                tmp = data;            
            }
        });
        return tmp;
    }    

    var all_events = allevents();
    console.log(all_events);
    $("#date").html(all_events['event'].startDateTime)
    $("#title").html(all_events['event'].title)
    $("#location").html(all_events['event'].fullAddress)
    $("#cover").css("background-image", "url('"+all_events['event'].cover+"')");
    $("#cover").removeClass("animate-pulse");
    $("#moreDetailsButton").attr("href", "/events/"+all_events['event'].uuid);

    if(all_events['otherEvents'].length > 0){
        all_events['otherEvents'].forEach(element => {
            $("#otherEvents").append(`
            <div class="h-16 rounded-lg bg-center bg-cover relative border-2 border-gray-500 hover:border-green-500 hover:-translate-y-1 transition-all duration-200 cursor-pointer" style="background-image: url('`+element.cover+`');">
                <span class="absolute inset-0 from-transparent to-black rounded-lg bg-gradient-to-b"></span>
                <div class="absolute inset-0 z-10 flex items-end justify-center text-white">
                    <div>`+element.title+`</div>
                </div>
            </div>`)
        });
        $("#otherParent").show();
    }
    else{
        $("#otherParent").hide()
    }

    map.setZoom(15);
    map.setCenter(new tt.LngLat(all_events['event'].longitude,all_events['event'].latitude));

    $("#eventCard").animate({
        bottom : '0px'
    }, 800);
}

$("#closeModal").on("click", () => {
    $("#eventCard").animate({
        bottom : '-100%'
    }, 800);

    map.zoomTo(10);
});

function handleResultSelection(event){
    var result = event.data.result;   
    searchMarker = new tt.Marker().setLngLat(result.position).addTo(map);
    map.setZoom(16);
    map.setCenter([result.position.lng, result.position.lat]);
}

/* Step Form */
if($('#stepForm').length > 0){
    var actualStep = 1;
    var nbStep = parseInt($('#stepForm')[0].attributes.stepform.value);

    var defaultClass = "py-3 w-1/4 flex justify-center gap-2.5 border-b-2 title-font font-medium items-center leading-none rounded-t cursor-pointer hover:bg-green-800 bg-gray-800";

    var status = {
        "focus": " bg-gray-700",
        "validate": " bg-gray-800 text-green-500 border-green-500",
        "not-validate":" bg-gray-800 text-red-500 border-red-500",
    };

    var validation = [];

    var prev_btn = document.getElementById('btnPrev');
    var next_btn = document.getElementById('btnNext');

    prev_btn.addEventListener('click',prevAction);
    next_btn.addEventListener('click',nextAction);

    $("#step"+actualStep)[0].classList.value = defaultClass + status['focus'];
    $('#form-step-'+actualStep)[0].style.display = 'flex';
}

function prevAction(){
    if(actualStep != 1){
        $("#step"+actualStep)[0].classList.value = defaultClass.concat((checkInputActualStep()) ? status['validate'] : status['not-validate']);
        $('#form-step-'+actualStep)[0].style.display = 'none';

        actualStep--;

        $("#step"+actualStep)[0].classList.value = defaultClass.concat(status['focus']);
        $('#form-step-'+actualStep)[0].style.display = 'flex';
    }
}

function nextAction(){
    if(actualStep != nbStep){
        $("#step"+actualStep)[0].classList.value = defaultClass.concat((checkInputActualStep()) ? status['validate'] : status['not-validate']);
        $('#form-step-'+actualStep)[0].style.display = 'none';

        actualStep++;

        $("#step"+actualStep)[0].classList.value = defaultClass.concat(status['focus']);
        $('#form-step-'+actualStep)[0].style.display = 'flex';
    }
}

function checkInputActualStep(){
    var inputValues = [];
    
    $('#form-step-'+actualStep+' :input').map(function() {
        if($(this).prop('required')){
            if($(this).val() == ''){
                inputValues.push(false);
            }
            else {
                inputValues.push(true);
            }
        }
    })

    var r = true;
    inputValues.forEach(element => {
        if(element == false){
            r = element
        }
    })
    return r;
}



if($('input[name=tags]').length > 0){
    var input = document.querySelector('input[name=tags]');
    var tagify = new Tagify(input,{maxTags: 5});
}





$("#btnToGetCenter").on("click", () => {
    let centerOfView = map.getCenter();
    $("#latitude").val(centerOfView.lat);
    $("#longitude").val(centerOfView.lng);
});

$('#deleteButton').on('click', function (e) {
    console.log(e.target.attributes[2].value)
});

