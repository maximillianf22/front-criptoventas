
<style type="text/css">
  .img-owl-carousel-container{
    border-radius: 0px 0px 80px 80px;"
  }
  .img-owl-carousel{
     min-width: 1355px!important;

     
      min-height: 350px!important;
  }

  @media only screen and (max-width: 768px) {
   .img-owl-carousel{
      min-width: 800px!important;
      max-width: 800px!important;
      max-height: 200px!important;
      min-height: 200px!important;
    }

    .img-owl-carousel-container{
      border-radius: 0px 0px 35px 35px;
    }
}
</style>
  <div class="owl-carousel owl-head owl-theme owl-loaded owl-drag" style="padding-top: 35px;">
      <div class="owl-stage-outer shadow img-owl-carousel-container">
         <div class="owl-stage">
              @foreach($sliders as $slider)
            <div class="owl-item col-lg-4 col-md-3 col-sm-4 col-6 p-0">
               <div class="item">
                  <div class="card-product m-0">
                     <div class="card-image p-0">
                      @isset($slider->redirect_url)
                         <a onclick="validateURL('{{$slider->redirect_url}}')" href="#"><img src="{{config('app.url_apiRequest') . 'storage/' . $slider->url }}" alt="..." class="img-owl-carousel no-border-radius"></a>
                        @else
                        <img src="{{config('app.url_apiRequest') . 'storage/' . $slider->url }}" alt="..." class="img-owl-carousel no-border-radius">
                        @endisset
                     </div>
                  </div>
               </div>
            </div>
               @endforeach
         </div>
      </div>
   </div>
<script type="text/javascript">
   function validateURL(str){
        
        if(!(str == "")){
        var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
        if (!(!!pattern.test(str))){
          window.open('/redirect/error')
        }else{
         window.open(str);
        }
  }
    }
  $('.owl-head').owlCarousel({
      loop: true,
      margin: 0,
      autoplay: true,
      autoplayTimeout: 4000,
      animateOut: 'fadeOut',
      autoplayHoverPause: true,
      responsiveClass: true,
      responsive: {
          0: {
              items: 1,
              loop: true,
              nav: false
          },
          600: {
              items: 1,
              loop: true,
              nav: false
          },
          1100: {
              items: 1,
              loop: true,
              nav: false
          }

      }
  })
</script>