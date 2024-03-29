@extends('System::backend.layouts.master')

@section('content')
    <script src="{{ asset('adminlte/plugins/ckeditor4101/ckeditor.js') }}"></script>
    <script>
        $(function () {
            CKEDITOR.replace('description', {
                filebrowserBrowseUrl: '{{ url(env('BACKEND_URI').'/ckfinderpopup') }}',
                filebrowserImageBrowseUrl: '{{ url(env('BACKEND_URI').'/ckfinderpopup') }}',
                filebrowserFlashBrowseUrl: '{{ url(env('BACKEND_URI').'/ckfinderpopup') }}',
            });
            CKEDITOR.config.extraPlugins = 'justify , colorbutton';
        });
    </script>
    <!-- Main content -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"> Edit: {{ $news->title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit News</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="main-inner">
                    <!-- *** Page title *** -->
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-create" id="form-create">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-table">
                                    <div class="card">
                                        <div class="card-body">
                                            {!! Form::model($news, ['method' => 'PATCH','route' => ['news.update', $news->id],'enctype' => 'multipart/form-data']) !!}
                                            <div class="mt-4 row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label for="title">Tiêu đề:</label>
                                                            <input name="title" type="text" class="form-control"
                                                                   id="title"
                                                                   placeholder="Title" value="{{ $news->title }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="news_slug">Đường dẫn SEO:</label>
                                                            <input name="news_slug" type="text" class="form-control"
                                                                   id="news_slug"
                                                                   placeholder="Đường dẫn SEO"
                                                                   value="{{ $news->news_slug }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <label for="author">Tác giả:</label>
                                                            <input name="author" type="text" class="form-control"
                                                                   id="author"
                                                                   value="{{ $news->author }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="author_email">Email:</label>
                                                            <input name="author_email" type="text" class="form-control"
                                                                   id="author_email" value="{{ $news->author_email }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="language">Danh mục:</label>
                                                            <div id="cats">
                                                                <select class="form-control" name="cats">
                                                                    <option value="">{{ __('admin.root_cat') }}</option>
                                                                    @if(count($cats) > 0)
                                                                        @foreach($cats as  $cate)
                                                                            <option
                                                                                value="{{$cate->id}}">{{ $cate->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="url">Ảnh:</label>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <button type="button" class="btn btn-default"
                                                                            onclick="selectFileWithCKFinder('image', 'logo-icon')">
                                                                        Chọn ảnh
                                                                    </button>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <img id="logo-icon" class="imgPreview"
                                                                         src="{{ old('image') }}"/>
                                                                    <input type="hidden" name="image" id="image"
                                                                           class="inputImg" value=""/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <label for="view_count">Lượt xem:</label>
                                                            <input name="view_count" type="text" class="form-control"
                                                                   id="view_count" value="{{ $news->view_count }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="language">Ngôn ngữ:</label>
                                                            <select class="form-control" name="language">
                                                                @if(count($languages) > 0)
                                                                    @foreach($languages as $lang)
                                                                        <option
                                                                            value="{{$lang['code']}}">{{$lang['name']}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="publish_date">Ngày đăng:</label>
                                                            <input name="publish_date" type="text" class="form-control"
                                                                   id="publish_date" value="{{ $news->publish_date }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="status">Trạng thái:</label>
                                                            <select class="form-control" name="status" id="status">
                                                                <option value="1" selected="selected">Bật</option>
                                                                <option value="0">Tắt</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="short_description">Mô tả ngắn:</label>
                                                        <textarea name="short_description" id="short_description"
                                                                  class="form-control"
                                                                  rows="2">{!! $news->short_description !!}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="content">Nội dung:</label>
                                                        <textarea name="description" id="description"
                                                                  class="form-control"
                                                                  rows="10">{!! $news->description !!}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="tags">Seo Title:</label>
                                                                <input name="meta[title]" type="text"
                                                                       class="form-control"
                                                                       value="{{ $news->meta['title'] ?? null }}"
                                                                       placeholder="Khoảng 60 ký tự">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="tags">Seo Description:</label>
                                                                <input name="meta[description]" type="text"
                                                                       class="form-control"
                                                                       value="{{ $news->meta['description'] ?? null }}"
                                                                       placeholder="Nội dung mô tả cho seo, khoảng 158 ký tự">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="tags">Seo Keyword:</label>
                                                                <input name="meta[keyword]" type="text"
                                                                       class="form-control"
                                                                       value="{{ $news->meta['keyword'] ?? null }}"
                                                                       placeholder="Các từ khóa seo của bài viết">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            {!! Form::close() !!}
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#title').focusout(function () {
                var pname = $(this).val();
                $.ajax({
                    url: '{{url('/').'/'.$backendUrl.'/make/ajaxslug'}}',
                    method: "post",
                    data: {
                        title: pname,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if (data) {
                            $("#news_slug").attr('value', data);
                        }
                    }

                });

            });
        });

    </script>
@endsection
