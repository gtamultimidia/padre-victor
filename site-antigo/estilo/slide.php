<style>
body {
  -webkit-font-smoothing: antialiased;
  padding-top: 135px;
  background-color: #fdf0d1;
}

#slides {
  display: none
}

#slides .slidesjs-navigation {
  margin-top:5px;
}

a.slidesjs-next,
a.slidesjs-previous,
a.slidesjs-play,
a.slidesjs-stop {
  background-repeat: no-repeat;
  display:block;
  width:12px;
  height:18px;
  overflow: hidden;
  text-indent: -9999px;
  float: left;
  margin-right:5px;
}

a.slidesjs-next {
	margin-right:10px;
	background-position: -12px 0;
	position: absolute;
	top: 37%;
	left: 98%;
	z-index: 20;
}

a:hover.slidesjs-next {
  background-position: -12px -18px;
}

a.slidesjs-previous {
	background-position: 0 0;
	position: absolute;
	top: 37%;
	left: 18px;
	z-index: 20;
}

a:hover.slidesjs-previous {
	background-position: 0 -18px;
}

a.slidesjs-play {
  width:15px;
  background-position: -25px 0;
}

a:hover.slidesjs-play {
  background-position: -25px -18px;
}

a.slidesjs-stop {
  width:18px;
  background-position: -41px 0;
}

a:hover.slidesjs-stop {
  background-position: -41px -18px;
}

.slidesjs-pagination {
	margin: 7px 0 0;
	float: right;
	list-style: none;
	position: absolute;
	margin-top: -33.5%;
	left: 50%;
	margin-left: -22.5px;
	z-index: 20;
}

.slidesjs-pagination li {
  float: left;
  margin: 0 1px;
}

.slidesjs-pagination li a {
  display: block;
  width: 13px;
  height: 0;
  padding-top: 13px;
  background-image: url(slide/img/pagination.png);
  background-position: 0 0;
  float: left;
  overflow: hidden;
}

.slidesjs-pagination li a.active,
.slidesjs-pagination li a:hover.active {
  background-position: 0 -13px
}

.slidesjs-pagination li a:hover {
  background-position: 0 -26px
}

#slides a:link,
#slides a:visited {
  color: #333
}

#slides a:hover,
#slides a:active {
  color: #9e2020
}

.navbar {
  overflow: hidden
}
</style>
<!-- End SlidesJS Optional-->

<!-- SlidesJS Required: These styles are required if you'd like a responsive slideshow -->
<style>
#slides {
  display: none
}

.container {
	margin: 0 auto;
	width: 100%;
	height: 61.5%;
	position: absolute;
}

/* For tablets & smart phones */
@media (max-width: 767px) {
  body {
    padding-left: 20px;
    padding-right: 20px;
  }
  .container {
    width: 100%;
	height: 61.5%;
	position: absolute;
  }
}

/* For smartphones */
@media (max-width: 480px) {
  .container {
    width: 100%;
	height: 61.5%;
	position: absolute;
  }
}

/* For smaller displays like laptops */
@media (min-width: 768px) and (max-width: 979px) {
  .container {
    width: 100%;
	height: 61.5%;
	position: absolute;
  }
}

/* For larger displays */
@media (min-width: 1200px) {
  .container {
    width: 100%;
	height: 61.5%;
	position: absolute;
  }
}
</style>