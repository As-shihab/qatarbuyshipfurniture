<div class="swiper myFullSectionSwiper relative group">
    <div class="swiper-wrapper">
        @foreach($sliders as $slider)
            <div class="swiper-slide">
                <section class="gj do ir hj sp jr i pg overflow-hidden">
                    {{-- Visual Background & Image Section --}}
                    <div class="xc fn zd/2 2xl:ud-w-187.5 bd 2xl:ud-h-171.5 h q r">
                        <img src="{{ asset('images/shape-01.svg') }}" alt="shape" class="xc 2xl:ud-block h t -ud-left-[10%] ua animate-pulse" />
                        <img src="{{ asset('images/shape-02.svg') }}" alt="shape" class="xc 2xl:ud-block h u p va opacity-50" />
                        <img src="{{ asset('images/shape-03.svg') }}" alt="shape" class="xc 2xl:ud-block h v w va animate-spin-slow" />
                        <img src="{{ asset('images/shape-04.svg') }}" alt="shape" class="h q r" />
                        
                        {{-- Dynamic Slider Image --}}
                        <img src="{{ asset('sliders/' . $slider->image) }}" alt="Slider Image" 
                             class="h q r ua hover:scale-105 transition-transform duration-700 object-contain" /> 
                    </div>

                    {{-- Content Section --}}
                    <div class="bb ze ki xn 2xl:ud-px-0 relative z-10">
                        <div class="tc _o">
                            <div class="animate_left jn/2">
                                {{-- Dynamic Title: Uses {!! !!} to allow <span> for styling --}}
                                <h1 class="fk vj zp or kk wm wb leading-tight">
                                    {!! $slider->title !!}
                                </h1>

                                {{-- Dynamic Description --}}
                                <p class="fq mt-4 text-lg opacity-90 max-w-lg">
                                    {{ $slider->description }}
                                </p>

                                {{-- Buttons & CTA --}}
                                <div class="tc tf yo zf mb mt-8 flex-wrap gap-6">
                                    <a href="{{ $slider->link ?? '#!' }}" class="ek jk lk gh gi hi rg ml il vc _d _l shadow-xl hover:shadow-indigo-500/50 transform hover:-translate-y-1 transition-all">
                                       Contact Us
                                    </a>
                                    
                                    <div class="flex items-center gap-4 border-l-2 border-slate-200 pl-6">
                                        <span class="tc sf">
                                            <a href="tel:50980124" class="block ek xj kk wm text-lg font-bold hover:text-indigo-600 transition-colors">
                                                Call 50980124
                                            </a>
                                            <span class="text-xs uppercase tracking-widest text-slate-400 font-bold">24/7 Expert Support</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        @endforeach
    </div>

    {{-- Navigation & Pagination --}}
    <div class="swiper-button-prev opacity-0 group-hover:opacity-100 p-3 text-white bg-black/30 hover:bg-black/80 rounded-full transition-all duration-300 left-4 !w-12 !h-12 !after:text-sm"></div>
    <div class="swiper-button-next opacity-0 group-hover:opacity-100 p-3 text-white bg-black/30 hover:bg-black/80 rounded-full transition-all duration-300 right-4 !w-12 !h-12 !after:text-sm"></div>
    <div class="swiper-pagination !bottom-8"></div>
</div>