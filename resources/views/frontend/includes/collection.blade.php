<a href="{{url('collections')}}/{{$collection->slug}}" class="col-md-6 col-12 collection-item" 
    {{-- style="background-image: url({{asset($collection->image)}});" --}}
    >
    <img src="{{asset($collection->image)}}" alt="" style="position: absolute;" loading="lazy">
    <div class="collection-text" style="z-index: 1;">
        <p class="collection-title-1 text-uppercase">Leather Collection</p>
        <p class="collection-title-2 text-uppercase">{{$collection->title}}</p>
    </div>
</a>