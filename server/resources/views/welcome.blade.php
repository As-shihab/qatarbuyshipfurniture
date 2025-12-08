@extends('layouts.app')

@section('content')
  <main>
    <!-- ===== Hero Start ===== -->
    @include('components.hero')
    <!-- ===== Hero End ===== -->

    <!-- ===== Small Features Start ===== -->
  <section id="features">
  <div class="bb ze ki yn 2xl:ud-px-12.5">
    <div class="tc uf zo xf ap zf bp mq">
      
      <div class="animate_top kn to/3 tc cg oq">
        <div class="tc wf xf cf ae cd rg mh">
          <img src="images/icon-01.svg" alt="Furniture Icon" />
        </div>
        <div>
          <h4 class="ek yj go kk wm xb">Buy Old Furniture</h4>
          <p>We purchase your used furniture, offering competitive value and hassle-free pickup.</p>
        </div>
      </div>

      <div class="animate_top kn to/3 tc cg oq">
        <div class="tc wf xf cf ae cd rg nh">
          <img src="images/icon-02.svg" alt="Shipping Truck Icon" />
        </div>
        <div>
          <h4 class="ek yj go kk wm xb">Provide Shipping Service</h4>
          <p>Reliable and insured shipping for purchased items or any of your logistical needs.</p>
        </div>
      </div>

      <div class="animate_top kn to/3 tc cg oq">
        <div class="tc wf xf cf ae cd rg oh">
          <img src="images/icon-03.svg" alt="Hiring Icon" />
        </div>
        <div>
          <h4 class="ek yj go kk wm xb">Hire Shipping Crew</h4>
          <p>Need moving assistance? Hire our professional and experienced shipping crew directly.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- galary section --}}

@include('components.galary')
    <!-- ===== Small Features End ===== -->

    <!-- ===== About Start ===== -->
  <section class="ji gp uq 2xl:ud-py-35 pg">
  <div class="bb ze ki xn wq">
    <div class="tc wf gg qq">
      
      <!-- About Images -->
      <div class="animate_left xc gn gg jn/2 i">
        <div>
          <img src="images/shape-05.svg" alt="Shape" class="h -ud-left-5 x" />
          <img src="images/about-01.png" alt="About" class="ib" />
          <img src="images/about-02.png" alt="About" />
        </div>
        <div>
          <img src="images/shape-06.svg" alt="Shape" />
          <img src="images/about-03.png" alt="About" class="ob gb" />
          <img src="images/shape-07.svg" alt="Shape" class="bb" />
        </div>
      </div>

      <!-- About Content -->
      <div class="animate_right jn/2">
        <h4 class="ek yj mk gb">Our Top Purchased Furnitures</h4>

        <h2 class="fk vj zp pr kk wm qb">
          Premium quality furniture trusted and purchased by thousands of customers.
        </h2>

        <p class="uo">
          Discover our most loved and frequently purchased furniture pieces. Each product is crafted with 
          durability, comfort, and modern design—making your home stylish, practical, and welcoming.
        </p>

        <a href="https://www.youtube.com/watch?v=xcJtL7QggTI" data-fslightbox class="vc wf hg mb">
          <span class="tc wf xf be dd rg i gh ua">
            <span class="nf h vc yc vd rg gh qk -ud-z-1"></span>
            <img src="images/icon-play.svg" alt="Play" />
          </span>
          <span class="kk">SEE OUR BEST SELLERS</span>
        </a>
      </div>

    </div>
  </div>
</section>



    <!-- ===== Services Start ===== -->
    @include('components.services')
    <!-- ===== Services End ===== -->





    <!-- ===== Projects End ===== -->

    <!-- ===== Counter Start ===== -->
    <section class="i pg qh rm ji hp">
      <img src="images/shape-11.svg" alt="Shape" class="of h ga ha ke" />
      <img src="images/shape-07.svg" alt="Shape" class="h ia o ae jf" />
      <img src="images/shape-14.svg" alt="Shape" class="h ja ka" />
      <img src="images/shape-15.svg" alt="Shape" class="h q p" />

      <div class="bb ze i va ki xn br">
        <div class="tc uf sn tn xf un gg">
          <div class="animate_top me/5 ln rj">
            <h2 class="gk vj zp or kk wm hc">785</h2>
            <p class="ek bk aq">Global Brands</p>
          </div>
          <div class="animate_top me/5 ln rj">
            <h2 class="gk vj zp or kk wm hc">533</h2>
            <p class="ek bk aq">Happy Clients</p>
          </div>
          <div class="animate_top me/5 ln rj">
            <h2 class="gk vj zp or kk wm hc">865</h2>
            <p class="ek bk aq">Winning Award</p>
          </div>
          <div class="animate_top me/5 ln rj">
            <h2 class="gk vj zp or kk wm hc">346</h2>
            <p class="ek bk aq">Happy Clients</p>
          </div>
        </div>
      </div>
    </section>
    <!-- ===== Counter End ===== -->


    <!-- ===== Blog Start ===== -->
    <section class="ji gp uq">
      <!-- Section Title Start -->
      <div
        x-data="{ sectionTitle: `Latest Blogs & News`, sectionTitleText: `It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using.`}">
        <div class="animate_top bb ze rj ki xn vq">
          <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b">
          </h2>
          <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
        </div>


      </div>
      <!-- Section Title End -->

      <div class="bb ye ki xn vq jb jo">
        <div class="wc qf pn xo zf iq">
          <!-- Blog Item -->
          <div class="animate_top sg vk rm xm">
            <div class="c rc i z-1 pg">
              <img class="w-full" src="images/blog-01.png" alt="Blog" />

              <div class="im h r s df vd yc wg tc wf xf al hh/20 nl il z-10">
                <a href="./blog-single.html" class="vc ek rg lk gh sl ml il gi hi">Read More</a>
              </div>
            </div>

            <div class="yh">
              <div class="tc uf wf ag jq">
                <div class="tc wf ag">
                  <img src="images/icon-man.svg" alt="User" />
                  <p>Musharof Chy</p>
                </div>
                <div class="tc wf ag">
                  <img src="images/icon-calender.svg" alt="Calender" />
                  <p>25 Dec, 2025</p>
                </div>
              </div>
              <h4 class="ek tj ml il kk wm xl eq lb">
                <a href="blog-single.html">Free advertising for your online business</a>
              </h4>
            </div>
          </div>

          <!-- Blog Item -->
          <div class="animate_top sg vk rm xm">
            <div class="c rc i z-1 pg">
              <img class="w-full" src="images/blog-02.png" alt="Blog" />

              <div class="im h r s df vd yc wg tc wf xf al hh/20 nl il z-10">
                <a href="./blog-single.html" class="vc ek rg lk gh sl ml il gi hi">Read More</a>
              </div>
            </div>

            <div class="yh">
              <div class="tc uf wf ag jq">
                <div class="tc wf ag">
                  <img src="images/icon-man.svg" alt="User" />
                  <p>Musharof Chy</p>
                </div>
                <div class="tc wf ag">
                  <img src="images/icon-calender.svg" alt="Calender" />
                  <p>25 Dec, 2025</p>
                </div>
              </div>
              <h4 class="ek tj ml il kk wm xl eq lb">
                <a href="blog-single.html">9 simple ways to improve your design skills</a>
              </h4>
            </div>
          </div>

          <!-- Blog Item -->
          <div class="animate_top sg vk rm xm">
            <div class="c rc i z-1 pg">
              <img class="w-full" src="images/blog-03.png" alt="Blog" />

              <div class="im h r s df vd yc wg tc wf xf al hh/20 nl il z-10">
                <a href="./blog-single.html" class="vc ek rg lk gh sl ml il gi hi">Read More</a>
              </div>
            </div>

            <div class="yh">
              <div class="tc uf wf ag jq">
                <div class="tc wf ag">
                  <img src="images/icon-man.svg" alt="User" />
                  <p>Musharof Chy</p>
                </div>
                <div class="tc wf ag">
                  <img src="images/icon-calender.svg" alt="Calender" />
                  <p>25 Dec, 2025</p>
                </div>
              </div>
              <h4 class="ek tj ml il kk wm xl eq lb">
                <a href="blog-single.html">Tips to quickly improve your coding speed.</a>
              </h4>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ===== Blog End ===== -->

    <!-- ===== Contact Start ===== -->
@include('components.contact')
    <!-- ===== Contact End ===== -->



    <!-- ===== CTA End ===== -->
  </main>
@endsection
