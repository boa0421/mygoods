{{-- タグ投稿フォーム --}}

<div class="container create-tags-wrapper" id="create-tags-show">
    <div class="row" id="modal-tags">
        <div class="close-modal">
            <i class="fa fa-2x fa-times"></i>
        </div>
        <div id="tags-form">
            <h2>Tag新規作成</h2>
            <form action="{{ action('Admin\TagsController@create') }}" method="post" enctype="multipart/form-data">
                <div class="error-message" onload="">
                    {{--@if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif--}}
                    
                    @if($errors->has('tag_name'))
                        <div class="error">
                            <p>{{ $errors->first('tag_name') }}</p>
                        </div>
                    @endif
                </div>
                <div class="form-group row">
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

{{-- エラーメッセージ アイテムのエラーメッセージも含む--}}

@if($errors->has('tag_name'))
    <script>
        window.onload = function() {
            $('#create-tags-show').fadeIn();
        }
    </script>
@elseif($errors->has('item_name'))
    <script>
        window.onload = function() {
            $('#create-items-show').fadeIn();
        }
    </script>
@endif