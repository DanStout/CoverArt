<div class="item-container">
    @forelse($covers as $cover)
        <div class="thumbnail item">
            <a href={!! route('covers.show', [$cover->id]) !!}>
                {!! Html::image($cover->small_preview_img_path, "Preview of {$cover->title}") !!}
            </a>
            <h4>{{$cover->title}} - {{$cover->platform->name}}</h4>
            <p>Uploaded {!! Html::time($cover->created_at) !!} by {!! Html::linkRoute('profiles.show', $cover->user->name, $cover->user->id) !!}
        </div>
    @empty
        <div>No covers found!</div>
    @endforelse
</div>
<div class="pagination-container">
    {!! $covers->render() !!}
</div>