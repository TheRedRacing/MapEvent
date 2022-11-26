import './bootstrap';
import jQuery, { css } from 'jquery';
import Alpine from 'alpinejs';

import tt from '@tomtom-international/web-sdk-maps';
import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';
import { set } from 'lodash';

window.$ = jQuery;
window.Alpine = Alpine;

Alpine.start();

var map = null;
var api = "GEJuHmudX7SntHEluTxaRHqQFHnCwSCU";
var csrf = $('meta[name="csrf-token"]')[0].content;
var mapView = "";
if($("#mapzoom").length > 0){
    mapView = $("#mapzoom").text();
    mapView = mapView.split(", ");
}
else { mapView = false; }
var z = (mapView != false) ? mapView[2].replace("x","") : 0;
var c = (mapView != false) ? [mapView[1],mapView[0]] : [0,0];
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
        if(all_events != null){ all_events.forEach(element => { points.push({ coordinates: [element.longitude, element.latitude], properties: { id: element.id, cover: element.cover }}) }); }

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
        boxZoom: false,
        dragRotate: false,
        touchZoomRotate: false,
        touchPitch: false,
        pitchWithRotate: false,
        doubleClickZoom: false,
        maxZoom: 18,
        snapZoom: 1,
    });

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
                markersOnTheMap[id] = addEventMarker(feature.geometry.coordinates,feature.properties.cover, feature.properties.id);
            }
        }
    });
}

function addEventMarker(latlng, cover, id){
    let markerElement = document.createElement('div');  
    
    let zoom = map.getZoom()   

    markerElement.className = 'event-'+ id+' block bg-center fit-cover bg-[length:100px] border-2 border-black rounded-md cursor-pointer';
    markerElement.style.backgroundImage = "url("+cover+")"
   

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

    markerElement.addEventListener("click", markerClick, 'event-'+ id)

    return new tt.Marker({element: markerElement, anchor: 'center'})
        .setLngLat(latlng)
        .addTo(map)
}

function markerClick(eventclick) {

    let id = eventclick.target.classList[0];  
    let marker = markersOnTheMap[id[id.length-1]];
    
    var allevents = function () {
        var tmp;
        $.ajax({
            type:'POST',
            url:'/getEvents/'+id[id.length-1],
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

    $("#parent-tabs").html("");
    $("#parent-btn-tabs").html("");

    var all_events = allevents();
    for (let i = 0; i < all_events.length; i++) {
        const element = all_events[i];
        generateEventCard(element,i+1)
    }

    console.log(all_events);

    $(".eventcard#1").css("display","flex");
    $(".openEvent-1").addClass("active");

    all_events[0].latitude = +(all_events[0].latitude);
    all_events[0].longitude = +(all_events[0].longitude);

    var latlng = new tt.LngLat(all_events[0].longitude, all_events[0].latitude);
    console.log(latlng);
    
    map.setZoom(18);
    map.setCenter(latlng);

    $("#eventinfo").show();
}

function generateEventCard(event,nb){
    //<div><i class="fas fa-fw fa-hashtag"></i> : `+event.tags+`</div>

    let date = new Date(event.startDateTime);
    console.log(date)

    console.log(event)
    $("#parent-tabs").append(`
        <div class="eventcard w-full h-full bg-gray-950 rounded-tr-md rounded-br-md rounded-bl-md flex-col flex-nowrap justify-between" id="`+nb+`" style="height: 85vh; display:none;">
            <div class="bg-cover bg-center relative rounded-tr-md" style="height:25vh; background-image: url('`+event.cover+`');">
                <div class="absolute -bottom-8 left-4 w-16 h-16 bg-cover bg-center rounded-2xl border-8 border-gray-950" style="background-image: url('https://flagcdn.com/`+event.country+`.svg');"></div>
            </div>
            <div class="pt-8 px-5 pb-2.5 flex-grow flex flex-col justify-start gap-2.5">
                <div class="text-2xl text-white flex justify-between items-center"><span>`+event.title+`</span><span>`+(event.private == 0 ? '<i class="far fa-globe"></i>' : '<i class="far fa-lock"></i>')+`</span></div>
                <hr class="border-gray-600 border-1">
                <div class="text-white flex flex-col gap-1">
                    <div><i class="fas fa-fw fa-clock"></i> : `+event.startDateTime+` (Local Time)</div>
                    <div><i class="fas fa-fw fa-map-pin"></i> : `+event.fullAddress+`</div>
                    
                    <div>0 Interessés • 0 Participants</div>
                </div>
                <hr class="border-gray-600 border-1">
                <div class="line-clamp-6 break-words text-white text-md">`+event.description+`</div>
            </div>
                
            <div class="flex justify-between items-center gap-5 pt-2.5 px-5 pb-5">
                <button class="border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 py-3 px-5 w-full flex justify-center items-center gap-2 bg-indigo-600 hover:bg-indigo-700">
                    <i class="fas fa-fw fa-check-square"></i> Participez
                </button>
                <button class="border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 py-3 px-5 w-full flex justify-center items-center gap-2 bg-gray-500 hover:bg-gray-600">
                    <i class="fas fa-fw fa-star"></i> Intéressé(e)
                </button>
            </div>
        </div>`
    );

    $("#parent-btn-tabs").append(`
        <button class="event-tablinks openEvent-`+nb+` block w-12 h-12 bg-gray-800 text-white first:rounded-tl-md last:rounded-bl-md hover:bg-indigo-600">`+nb+`</button>
    `);
}

$("#parent-btn-tabs").on("click",".event-tablinks", function(e){
    openEvent(e,e.target.classList[1][e.target.classList[1].length-1])
})

function openEvent(evt, eventId) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("eventcard");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("event-tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(eventId).style.display = "flex";
    evt.currentTarget.className += " active";
}

$(".event-card-close").on("click",function(e){
    $("#eventinfo").hide();
    map.setCenter(c);
    map.zoomTo(z,{duration:1000});
})

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