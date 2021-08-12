@extends('master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pannellum.css') }}">
    <style>
        #panorama {
            height: 500px;
        }
        #controls {
            position: absolute;
            bottom: 0;
            z-index: 2;
            text-align: center;
            width: 100%;
            padding-bottom: 3px;
        }
        .ctrl {
            padding: 8px 5px;
            width: 30px;
            text-align: center;
            background: rgba(200, 200, 200, 0.8);
            display: inline-block;
            cursor: pointer;
        }
        .ctrl:hover {
            background: rgba(200, 200, 200, 1);
        }
    </style>
@endsection
@section('main')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Pannellum
        </h2>
    </div>

    <div id="panorama" class="w-full">
        <div id="controls">
            {{-- &#9650;  --}}
            <div class="ctrl" id="pan-up"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>
            {{-- &#9660; --}}
            <div class="ctrl" id="pan-down"><i class="fa fa-arrow-down" aria-hidden="true"></i></div>
            {{-- &#9664; --}}
            <div class="ctrl" id="pan-left"><i class="fa fa-arrow-left" aria-hidden="true"></i></div>
            {{-- &#9654; --}}
            <div class="ctrl" id="pan-right"><i class="fa fa-arrow-right" aria-hidden="true"></i></div>
            {{----}}
            <div class="ctrl font-bold" id="zoom-in">&plus;</div>
            {{----}}
            <div class="ctrl font-bold" id="zoom-out">&minus;</div>
            {{-- &#x2922; --}}
            <div class="ctrl" id="fullscreen"><i class="fa fa-expand" aria-hidden="true"></i></div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/pannellum.js') }}"></script>
    <script type="text/javascript">
        viewer = pannellum.viewer('panorama', {
            "showZoomCtrl": false,
            "showFullscreenCtrl": false,
            // Auto load image
            "autoLoad": true,
            // Slow motion after dragged and release mouse
            "friction": "0.2",
            "default": {
                "firstScene": "scene_one",
                "sceneFadeDuration": 1000
            },
            "scenes": {
                "scene_one": {
                    "title": "Scene One",
                    // Zoom scale
                    "hfov": 110,
                    // Direction to down
                    "pitch": -2,
                    // Direction to right
                    "yaw": 117,
                    "type": "equirectangular",
                    "panorama": "/images/panorama/scene_one.jpg",
                    "hotSpots": [
                        {
                            "pitch": -2.1,
                            "yaw": 132.9,
                            "type": "scene",
                            "text": "Go To Scene Two",
                            "sceneId": "scene_two"
                        }
                    ]
                },

                "scene_two": {
                    "title": "Scene Two",
                    "hfov": 110,
                    "yaw": 5,
                    "type": "equirectangular",
                    "panorama": "/images/panorama/scene_two.jpg",
                    "hotSpots": [
                        {
                            "pitch": -0.6,
                            "yaw": 37.1,
                            "type": "scene",
                            "text": "Go To Scene One",
                            "sceneId": "scene_one",
                            "targetYaw": -23,
                            "targetPitch": 2
                        }
                    ]
                }
            }
        });
        // Make buttons work
        document.getElementById('pan-up').addEventListener('click', function(e) {
            viewer.setPitch(viewer.getPitch() + 10);
        });
        document.getElementById('pan-down').addEventListener('click', function(e) {
            viewer.setPitch(viewer.getPitch() - 10);
        });
        document.getElementById('pan-left').addEventListener('click', function(e) {
            viewer.setYaw(viewer.getYaw() - 10);
        });
        document.getElementById('pan-right').addEventListener('click', function(e) {
            viewer.setYaw(viewer.getYaw() + 10);
        });
        document.getElementById('zoom-in').addEventListener('click', function(e) {
            viewer.setHfov(viewer.getHfov() - 10);
        });
        document.getElementById('zoom-out').addEventListener('click', function(e) {
            viewer.setHfov(viewer.getHfov() + 10);
        });
        document.getElementById('fullscreen').addEventListener('click', function(e) {
            viewer.toggleFullscreen();
        });
    </script>
@endsection