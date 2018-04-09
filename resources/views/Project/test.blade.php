@extends('layout')

@section('content')

<!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css'>
  <link rel="stylesheet" type="text/css" href="/css/testdemo.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="js/testindex.js"></script>
 -->
 <link rel="stylesheet" type="text/css" href="/css/csslider.default.css"/>
<!-- <link rel="stylesheet" type="text/css" href="/css/testdemo.css"/> -->
<style>
        @import url(http://fonts.googleapis.com/css?family=Raleway:400,700|Lato);

        
    
        #slider1 {
            margin: 20px;
            font-family: 'Lato';
        }

            #slider1 > ul > li:nth-of-type(3) {
                background: url(./themes/fruit.jpg);
            }

            #slider1 > input:nth-of-type(3):checked ~ ul #bg {
                width: 80%;
                padding: 22px;
                -moz-transition: .5s .5s;
                -o-transition: .5s .5s;
                -webkit-transition: .5s .5s;
                transition: .5s .5s;
            }

                #slider1 > input:nth-of-type(3):checked ~ ul #bg div {
                    -moz-transform: translate(0);
                    -ms-transform: translate(0);
                    -o-transform: translate(0);
                    -webkit-transform: translate(0);
                    transform: translate(0);
                    -moz-transition: .5s .9s;
                    -o-transition: .5s .9s;
                    -webkit-transition: .5s .9s;
                    transition: .5s .9s;
                }

        #bg {
            color: #000;
            padding: 22px 0;
            position: absolute;
            left: 0;
            top: 16%;
            height: 20%;
            width: 0;
            z-index: 10;
            overflow: hidden;
        }

            #bg:before {
                content: '';
                position: absolute;
                left: -1px;
                top: 1px;
                height: 100%;
                width: 100%;
                z-index: -1;
                background: url(./themes/fruit.jpg) 1px 23%;
                -webkit-filter: blur(7px);
            }

            #bg:after {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                width: 100%;
                z-index: 20;
                background: rgba(0, 0, 0, 0.35);
                pointer-events: none;
            }

            #bg div {
                -moz-transform: translate(120%);
                -ms-transform: translate(120%);
                -o-transform: translate(120%);
                -webkit-transform: translate(120%);
                transform: translate(120%);
            }

        .scrollable p {
            padding: 30px;
            text-align: justify;
            line-height: 140%;
            font-size: 120%;
        }
    </style>
    <div id="slider1" class="csslider">
        <input type="radio" name="slides" id="slides_1" />
        <input type="radio" name="slides" id="slides_2" checked />
        <input type="radio" name="slides" id="slides_3" />
        <input type="radio" name="slides" id="slides_4" />
        <ul>
            <li>
                <h1>Say hello to CSS3</h1>
                <p>CSSlider is lightweight & easy to use slider. No JS - pure CSS.</p>
            </li>
            <li>
                <img src="./themes/stones.jpg" />
            </li>
            <li>
                <div id="bg">
                    <div>
                        <h1>CSS Events</h1>
                        <p>When slide 3 is reached - play CSS animation!</p>
                    </div>
                </div>
            </li>
            <li class="scrollable">
                <h1>Lots of text</h1>
                <h2>Scrollable one</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce vel sapien elit in malesuada mi,
                    semper id sollicitudin urna fermentum ut fusce varius nisl ac ipsum gravida vel pretium tellus.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce vel sapien elit in malesuada mi,
                    semper id sollicitudin urna fermentum ut fusce varius nisl ac ipsum gravida vel pretium tellus.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce vel sapien elit in malesuada mi,
                    semper id sollicitudin urna fermentum ut fusce varius nisl ac ipsum gravida vel pretium tellus.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce vel sapien elit in malesuada mi,
                    semper id sollicitudin urna fermentum ut fusce varius nisl ac ipsum gravida vel pretium tellus.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce vel sapien elit in malesuada mi,
                    semper id sollicitudin urna fermentum ut fusce varius nisl ac ipsum gravida vel pretium tellus.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce vel sapien elit in malesuada mi,
                    semper id sollicitudin urna fermentum ut fusce varius nisl ac ipsum gravida vel pretium tellus.
                </p>
            </li>
        </ul>
        <div class="arrows">
            <label for="slides_1"></label>
            <label for="slides_2"></label>
            <label for="slides_3"></label>
            <label for="slides_4"></label>
        </div>
        <div class="navigation">
            <div>
                <label for="slides_1"></label>
                <label for="slides_2"></label>
                <label for="slides_3"></label>
                <label for="slides_4"></label>
            </div>
        </div>
    </div>
@stop