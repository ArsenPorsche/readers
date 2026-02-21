<aside class="col-sm-3 ml-sm-auto blog-sidebar">
    <div class="sidebar-module">
        <h4>Najnowsze posty</h4>
        <ol class="list-unstyled">
            @php
                use App\Models\Post;
                $newest = Post::newest(2);
            @endphp
            @foreach ($newest as $post)
                <li>
                    <a href="{{asset('/posty/'.$post->id)}}">{{$post->title}} </a>
                </li>
            @endforeach
        </ol>
    </div>
</aside>
