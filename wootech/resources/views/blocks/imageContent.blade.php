{{--
  Title: Image Content
  Description: Image With Content
  Category: wootech
  Icon: align-pull-left
  Keywords: image content text
  Mode: edit
  Align: full
  PostTypes: page
  SupportsAlign: false
  SupportsMode: true
  SupportsMultiple: true
--}}

@if(!empty(get_field('image')) && !empty(get_field('content')))
<section data-{{ $block['id'] }} class="relative flex flex-col pt-14 pb-7 lg:py-0 lg:flex-col {{ $block['classes'] }} @if(get_field('section_background') == 'white') bg-white @endif" id="{{ $block['id'] }}">
  <div class="inset-y-0 top-0 @if(get_field('image_position') == 'right') right-0 @else left-0 @endif w-full mb-8 lg:mb-0 lg:w-1/2 lg:pr-4 lg:absolute" data-aos="fade-up" data-aos-duration="1000">
    <img class="object-cover w-full h-full" src="{!! get_field('image')['url'] !!}" width="960" height="400" alt="{!! get_field('image')['title'] !!}">
  </div>
  <div class="container flex flex-wrap @if(get_field('image_position') == 'right') justify-start @else justify-end @endif">
    <div class="lg:w-1/2 lg:pl-16 lg:pr-3 lg:py-12" data-aos="fade-up" data-aos-duration="500">
      <div class="flex flex-wrap items-baseline text-blue-100">
        @if(!empty(get_field('heading')))
          <h2>{!! get_field('heading') !!}</h2>
        @endif
        @if(!empty(get_field('icon')))
          <img class="ml-4" src="{!! get_field('icon')['url'] !!}" width="36" height="37" alt="{!! get_field('icon')['title'] !!}">
        @endif
      </div>
      @if(!empty(get_field('sub_heading')))
        <h3 class="text-blue-200 text-[22px] mb-7">{!! get_field('sub_heading') !!}</h3>
      @endif
      <div class="text-lg font-light mb-8">{!! get_field('content') !!}</div>
      @if(!empty(get_field('button')))
        <div class="py-2 mb-4">
          <a  class="linline-block px-8 py-4 text-[13px] font-bold transition duration-200 text-white hover:text-white focus:text-white bg-blue-100 hover:bg-blue-100 focus:bg-blue-100 hover:shadow-xs focus:shadow-xs focus:outline-none" href="{!! get_field('button')['url'] !!}" target="@if(!empty(get_field('button')['target'])) {!! get_field('button')['target'] !!} @else _self @endif">{!! get_field('button')['title'] !!}</a>
        </div>
      @endif
    </div>
  </div>
</section><!-- /.Image Content -->
@endif