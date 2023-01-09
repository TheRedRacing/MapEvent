import tt from '@tomtom-international/web-sdk-maps';
import { initial, takeWhile } from 'lodash';
/* import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';
import { set } from 'lodash'; */

export class MapEvents {
    constructor(HTMLElement){
        this.csrf = $('meta[name="csrf-token"]')[0].content;
        // Id
        this.id = HTMLElement.id;
        this.defaultview = JSON.parse(HTMLElement.attributes.defaultview.value);
        this.centerMarker = JSON.parse(HTMLElement.attributes.centerMarker.value);
        this.desableScroll = JSON.parse(HTMLElement.attributes.desableScroll.value);
        this.getDataB = JSON.parse(HTMLElement.attributes.getData.value);
        
        this.setMapview();
        this.init();
        (this.getDataB) ? this.getData() : null ;
        (this.centerMarker) ? this.addMarker() : null ;
    }

    get getid() {
        return this.id;
    }

    setMapview(){
        this.latitude = this.defaultview[0];
        this.longitude = this.defaultview[1];
        this.zoom = this.defaultview[2];
        this.center = [this.longitude, this.latitude];
    }

    get getLanguage(){
        return navigator.languages && navigator.languages.length ? navigator.languages[0] : navigator.language;
    }

    getData(){
        var geoJson = {};
        var markersOnTheMap = {};
        var eventListenersAdded = false;


        // Event from database
        var events = function () {
            var tmp;
            $.ajax({ type:'POST', url:'/getEvents', async: false, global: false, headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]')[0].content }, dataType: 'json',
                success:function(data) { tmp = data; }
            });
            return tmp;
        }
        var all_events = events();
        var points = [];
        if(all_events != null){ all_events.forEach(element => { points.push({ coordinates: [element.longitude, element.latitude], properties: { id: element.id, uuid: element.uuid, cover: element.cover }}) }); }

        //Get Data here
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
        
        var refreshMarkers = function(map) {
            Object.keys(markersOnTheMap).forEach(function(id) {
                markersOnTheMap[id].remove();
                delete markersOnTheMap[id];
            });
        
            map.querySourceFeatures('point-source').forEach(function(feature) {
                if (feature.properties && !feature.properties.cluster) {
                    var id = parseInt(feature.properties.id, 10);
                    if (!markersOnTheMap[id]) {
                        markersOnTheMap[id] = addEventMarker(map, feature.geometry.coordinates,feature.properties.cover, feature.properties.uuid);
                    }
                }
            });
        }

        var addEventMarker = function(map,latlng, cover, uuid) {
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
        
            //markerElement.addEventListener('click', openBottomModal, uuid)
        
            return new tt.Marker({element: markerElement, anchor: 'center'})
                .setLngLat(latlng)
                .addTo(map)
        }

        this.map.on('load', function(e) { 
            console.log('test')
            console.log(e.target) 
            console.log(geoJson)        
            e.target.addSource('point-source', {
                type: 'geojson',
                data: geoJson,
                cluster: true,
                clusterMaxZoom: 14,
                clusterRadius: 50
            });

            e.target.addLayer({
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

            e.target.addLayer({
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

            e.target.on('data', function(e) {
                if (e.sourceId !== 'point-source' || !e.target.getSource('point-source').loaded()) {
                    return;
                }
                refreshMarkers(this)
                if (!this.eventListenersAdded) {
                    e.target.on('move', refreshMarkers(this));
                    e.target.on('moveend', refreshMarkers(this));
                    this.eventListenersAdded = true;
                }
            });

            e.target.on('click', 'clusters', function(e) {
                var features = map.queryRenderedFeatures(e.point, { layers: ['clusters'] });
                var clusterId = features[0].properties.cluster_id;
                e.target.getSource('point-source').getClusterExpansionZoom(clusterId, function(err, zoom) {
                    if (err) {
                        return;
                    }
                    e.target.easeTo({
                        center: features[0].geometry.coordinates,
                        zoom: zoom + 0.5
                    });
                });
            });

            e.target.on('mouseenter', 'clusters', function() {
                e.target.getCanvas().style.cursor = 'pointer';
            });
            e.target.on('mouseleave', 'clusters', function() {
                e.target.getCanvas().style.cursor = '';
            }); 
            
    
            //map.on("zoom", () => { $("#mapzoom").html(getMapInfo()); });
            //map.on("move", () => { $("#mapzoom").html(getMapInfo()); });   
        });
    }

    get getGeoJson() {
        return this.geoJson;
    }

    init(){
        this.api = "GEJuHmudX7SntHEluTxaRHqQFHnCwSCU";

        this.setMapview()        

        this.map = tt.map({
            key: this.api,
            container: this.id,
            language: this.getLanguage,
            center: this.center,
            zoom: this.zoom,
            scrollZoom: !this.desableScroll,
            boxZoom: false,
            dragRotate: false,
            touchZoomRotate: true,
            pitchWithRotate: false,
            doubleClickZoom: false,
            maxZoom: 18,
            snapZoom: 1,
        });

        this.map.touchZoomRotate.disableRotation();
    }

    addMarker(){
        new tt.Marker().setLngLat(this.center).addTo(this.map);
    }

    get getMap(){
        return this.map;
    }

    get getDataBool(){
        return this.getDataB;
    }
}