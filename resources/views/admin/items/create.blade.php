<div class="container create-items-wrapper" id="create-items-show">
    <div class="row" id="modal-items">
        <div class="col-md-8 mx-auto">
            <div class="close-modal">
                <i class="fa fa-2x fa-times"></i>
            </div>
            <div id="items-form">
                <h2>アイテム作成</h2>
                <form action="{{ action('Admin\ItemsController@create') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <!--<label class="col-md-2">名前</label>-->
                        <div class="col-md-10">
                            <input type="text" placeholder="名前" class="form-control" name="item_name" value="{{ old('item_name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <!--<label class="col-md-2">店名 URLを入力してください</label>-->
                        <div class="col-md-10">
                            <input type="url" placeholder="店名　URLを入力してください" class="form-control" name="shop" value="{{ old('shop') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="item_image">
                        </div>
                    </div>
                    <input type="hidden" name="post_id" value="{{ $post_id }}">
                    {{ csrf_field() }}
                    <input type="submit" id='item-submit-btn' value="更新">
                    
                </form>
            </div>
        </div>
    </div>
</div>
