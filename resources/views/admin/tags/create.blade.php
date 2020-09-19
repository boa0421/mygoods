<div class="container create-tags-wrapper" id="create-tags-show">
    <div class="row" id="modal-tags">
        <div class="close-modal">
            <i class="fa fa-2x fa-times"></i>
        </div>
        <div id="tags-form">
            <h2>Tag新規作成</h2>
            <form action="{{ action('Admin\TagsController@create') }}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group row">
                    <!--<label class="col-md-2">タグ</label>-->
                    <div class="col-md-10">
                        <input type="text" placeholder="タグ" class="form-control" name="tag_name" value="{{ old('tag_name') }}">
                    </div>
                </div>
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                {{ csrf_field() }}
                <input type="submit" id="tags-submit-btn" value="登録">
            </form>
        </div>
    </div>
</div>
