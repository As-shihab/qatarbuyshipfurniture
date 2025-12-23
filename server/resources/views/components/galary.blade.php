<section class="i pg ji gp uq" id="furnitures">
  <!-- Bg Shapes -->
  <span class="rc h s r vd fd/5 fh rm"></span>
  <img src="images/shape-08.svg" alt="Shape Bg" class="h q r" />
  <img src="images/shape-09.svg" alt="Shape" class="of h y z/2" />
  <img src="images/shape-10.svg" alt="Shape" class="h _ aa" />
  <img src="images/shape-11.svg" alt="Shape" class="of h m ba" />

  <!-- Section Title Start -->
  <div
    x-data="{ sectionTitle: `Our Top Purchased Furnitures`, sectionTitleText: `Explore our most popular and best-selling furniture pieces that customers love the most. Each item is selected for premium quality, durability, and modern style to give your home a perfect touch.` }">
    <div class="animate_top bb ze rj ki xn vq">
      <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b"></h2>
      <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
    </div>
  </div>
  <!-- Section Title End -->

  <div class="bb ze i va ki xn xq jb jo">
    <div class="wc qf pn xo gg cp grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

@foreach($galleries as $gallery)
  <div style="
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        margin-bottom: 24px;
      "
      onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.2)';"
      onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.1)';"
  >
    
    @if($gallery->file_name)
      <div style="position: relative;">
       <img src="{{ asset('galaray/' . $gallery->file_name) }}"
     alt="{{ $gallery->title }}"
     style="width: 100%; height: 256px; object-fit: cover; display: block;" />
        <span style="
              position: absolute;
              top: 8px;
              right: 8px;
              background: #EDE9FE;
              color: #6B21A8;
              font-size: 12px;
              font-weight: bold;
              padding: 4px 8px;
              border-radius: 8px;
            ">
          {{ ucfirst($gallery->status) }}
        </span>
      </div>
    @endif

    <div style="padding: 16px; text-align: center;">
      <h4 style="font-size: 18px; font-weight: 600; margin: 8px 0;">{{ $gallery->title }}</h4>
      <p style="font-size: 14px; color: #4B5563; margin: 8px 0;">{{ $gallery->description }}</p>

      <div style="margin-top: 12px;">
        <ul style="list-style: none; padding: 0; display: flex; justify-content: center; gap: 12px;">
          <li><a href="#!" style="color: #3B82F6; text-decoration: none; font-weight: bold;">Q</a></li>
          <li><a href="#!" style="color: #0EA5E9; text-decoration: none; font-weight: bold;">B</a></li>
          <li><a href="#!" style="color: #1D4ED8; text-decoration: none; font-weight: bold;">S</a></li>
                    <li><a href="#!" style="color: #1D4ED8; text-decoration: none; font-weight: bold;">F</a></li>
        </ul>
      </div>
    </div>

  </div>
@endforeach



    </div>
  </div>
</section>
