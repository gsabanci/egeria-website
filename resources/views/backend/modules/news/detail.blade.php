@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif
<form class="card card-custom" action="{{ route('admin.news_update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="news_guid" value="{{ $news->news_guid }}">
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{ $news->title }} Detay</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">Aşağıda sistemde yer alan {{ $news->title }}
                adlı
                haber detayını görebilirsiniz.</span>
        </h3>
    </div>

    <div class="card-body py-0">
        <div class="row">
            {{-- <div class="col-lg-3 col-md-12 form-group">
                <div class="newsprevlabel">
                    Haber Kartı Önizleme
                </div>
                <div class="newsprev">
                    <div class="card">
                        <img src="{{ asset('/storage/news_photos/' . $news->coverimage) }}"
                            id="edit_news_image_{{ $news->id }}" class="newsimage">
                        <div class="card-body">
                            <div class="newstitle edit_news_title" id="edit_news_title_{{ $news->id }}">
                                {{ $news->title }}
                            </div>
                            <div class="newsdesc" id="edit_news_desc_{{ $news->id }}">
                                {{ $news->short_desc }}
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-12 col-12 form-group">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Haber
                        Başlığı</label>
                    <input type="text" class="form-control" value="{{ $news->title }}" name="title"
                        onkeyup="editPrevTitle(event, {{ $news->id }})">
                    <input type="hidden" name="news_guid" value="{{ $news->news_guid }}">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Haber Kategorisi</label>
                    <select class="form-control" name="nc_guid">
                        <option value="">Kategori seçin</option>
                        @foreach ($categories as $c)
                            <option value="{{ $c->nc_guid }}"
                                {{ $news->nc_guid == $c->nc_guid ? 'selected' : null }}>{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Kısa
                        Açıklama</label>
                    <textarea type="text" rows="6" class="form-control" name="short_desc"
                        onkeyup="editPrevShort(event, {{ $news->id }})">{{ $news->short_desc }}</textarea>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">İçerik
                        Resmi</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="customFile">
                        <label class="custom-file-label" for="customFile">Resim
                            Seçiniz</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Kapak
                        Resmi</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="coverimage" id="customFile"
                            onchange="editPrevImage(event, {{ $news->id }})">
                        <label class="custom-file-label" for="customFile">Resim
                            Seçiniz</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Haber
                        Detay</label>
                    <textarea class="summernote" type="text" name="detail" class="form-control">{{ $news->detail }}</textarea>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Görüntülenme Sırası</label>
                    <input type="number" min="0" max="1000000" class="form-control"
                        value="{{ $news->queue }}" name="queue">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Durumu</label>
                    <select class="form-control" name="is_active">
                        <option {{ $news->is_active == '1' ? 'selected' : '' }} value="1">Aktif</option>
                        <option {{ $news->is_active == '0' ? 'selected' : '' }} value="0">Pasif</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer d-flex justify-content-end">
        <button type="submit" value="submit" class="btn btn-primary">Kaydet</button>
    </div>
</form>
@section('js')
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                minHeight: 300,
                toolbar: [
                    ['cleaner', ['cleaner']],
                    ['style', ['style']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],

                ],

            });
        })

        var editPrevImage = function(event, id) {
            var output = document.getElementById('edit_news_image_' + id);
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };

        var editPrevTitle = function(event, id) {
            $('#edit_news_title_' + id).html('');
            $('#edit_news_title_' + id).html(event.target.value);
        }

        var editPrevShort = function(event, id) {
            $('#edit_news_desc_' + id).html('');
            $('#edit_news_desc_' + id).html(event.target.value);
        }
    </script>
    <script src="{{ asset('backend/assets/js/summernote.js') }}"></script>
    <script src="{{ asset('backend/assets/js/summernote-cleaner.js') }}"></script>
@endsection
