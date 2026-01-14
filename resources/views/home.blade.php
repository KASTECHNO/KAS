<div class="row ">
    @foreach($projects as $project)
    <div class="col-lg-4 col-sm-6 ">
        <div class="item ">
            <span class="icon feature_box_col_four ">
                <i class="{{ $project->icon }}"></i>
            </span>
            <h6>{{ $project->title }}</h6>
            <p>{{ $project->description }}</p>
        </div>
    </div>
    @endforeach
</div>
