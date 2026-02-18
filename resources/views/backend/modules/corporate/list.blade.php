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
<div class="card card-custom">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">Kurumsal</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">Aşağıda sistemde yer alan bütün kurumsal
                içerikleri
                görebilirsiniz.</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <!-- Success GELİCEK-->

    <div class="card-body py-0">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
                <thead>
                    <tr class="text-left">
                        <th style="max-width: 100px">ID</th>
                        <th style="min-width: 200px">Başlık</th>
                        <th style="min-width: 200px">Dil Kodu</th>
                        <th style="min-width: 50">Görüntülenme Sırası</th>
                        <th style="min-width: 120px">Durumu</th>
                        <th class="pr-0 text-right" style="min-width: 160px">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($corporates as $corporate)
                        <tr>
                            <td>#{{ $corporate->id }}</td>
                            <td>
                                <span
                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $corporate->title }}</span>
                                <span class="text-muted font-weight-bold">{{ $corporate->slug }}</span>
                            </td>
                            <td class="font-weight-bolder">{{ strtoupper($corporate->lang_code) }}</td>
                            <td>{{ !is_null($corporate->queue) ? $corporate->queue : 'Belirlenmemiş' }}</td>
                            <td>
                                @if ($corporate->status == '1')
                                    <span class="label label-lg label-light-success label-inline">Aktif</span>
                                @else
                                    <span class="label label-lg label-light-danger label-inline">Pasif</span>
                                @endif
                            </td>
                            <td class="pr-0 text-right">
                                <a href="" data-toggle="modal" data-target="#modal_{{ $corporate->id }}"
                                    class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Write.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)">
                                                </path>
                                                <path
                                                    d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#delete_{{ $corporate->id }}"
                                    class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Trash.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path
                                                    d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                    fill="#000000" fill-rule="nonzero"></path>
                                                <path
                                                    d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                    fill="#000000" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <div class="modal fade" id="modal_{{ $corporate->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Kurumsal İçerik Düzenle
                                            <span class="text-primary font-weight-bold ml-2" style="font-size:14px;">
                                                [{{ strtoupper($corporate->lang_code) }}]
                                            </span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.corporate_edit') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $corporate->id }}">

                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="slug_{{ $corporate->id }}">Tanımlayıcı (URL Başlığı) <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="slug_{{ $corporate->id }}"
                                                    name="slug" required value="{{ $corporate->slug }}" />
                                                <small class="form-text text-muted">
                                                    Not: Bu alan diller arasında ortak bir anahtardır (ID). Aynı içeriğin
                                                    farklı dilleri için aynı id kullanılmalıdır
                                                </small>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Başlık</label>
                                                <input type="text" class="form-control" value="{{ $corporate->title }}"
                                                    name="title">
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">İçerik</label>
                                                <textarea name="content" class="summernote"
                                                    required>{!! $corporate->content !!}</textarea>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Kapak Resmi</label>

                                                        @if(!empty($corporate->image))
                                                            <div class="mb-2">
                                                                <img id="edit_corporate_image_{{ $corporate->id }}"
                                                                    src="{{ asset('storage/corporate/cover/' . $corporate->image) }}"
                                                                    alt="Kapak" style="width:240px; height:60px; object-fit:cover; border-radius:10px; border:1px solid #eee;
                                                                             box-shadow:0 4px 12px rgba(0,0,0,.08);">
                                                            </div>

                                                            <small class="text-muted d-block mb-2">
                                                                Mevcut resim yüklü. Değiştirmek istersen aşağıdan yeni resim
                                                                seç.
                                                            </small>
                                                        @else
                                                            <div class="mb-2 p-3"
                                                                style="border:1px dashed #ddd; border-radius:12px; color:#888;">
                                                                Mevcut kapak resmi yok.
                                                            </div>
                                                            <img id="edit_corporate_image_{{ $corporate->id }}"
                                                                style="display:none; width:100%; max-height:220px; object-fit:cover; border-radius:12px; border:1px solid #eee;">
                                                        @endif

                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="image"
                                                                id="editImage_{{ $corporate->id }}" accept="image/*"
                                                                onchange="editPrevImage(event, {{ $corporate->id }})">
                                                            <label class="custom-file-label"
                                                                for="editImage_{{ $corporate->id }}">Yeni resim seç
                                                                (opsiyonel)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Doküman</label>

                                                        @if(!empty($corporate->docname))
                                                            <div class="d-flex align-items-center justify-content-between mb-2 p-3"
                                                                style="border:1px solid #eee; border-radius:12px;">
                                                                <div>
                                                                    <div class="font-weight-bolder">Mevcut doküman</div>
                                                                    <div class="text-muted" style="font-size:13px;">
                                                                        {{ $corporate->docname }}
                                                                    </div>
                                                                </div>
                                                                <a class="btn btn-sm btn-light-primary"
                                                                    href="{{ asset('storage/corporate/file/' . $corporate->docname) }}"
                                                                    target="_blank" download>
                                                                    İndir
                                                                </a>
                                                            </div>

                                                            <small class="text-muted d-block mb-2">
                                                                Mevcut doküman yüklü. Değiştirmek istersen aşağıdan yeni doküman
                                                                seç.
                                                            </small>
                                                        @else
                                                            <div class="mb-2 p-3"
                                                                style="border:1px dashed #ddd; border-radius:12px; color:#888;">
                                                                Mevcut doküman yok.
                                                            </div>
                                                        @endif

                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="docname"
                                                                id="editDoc_{{ $corporate->id }}"
                                                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                                                            <label class="custom-file-label"
                                                                for="editDoc_{{ $corporate->id }}">Yeni doküman seç
                                                                (opsiyonel)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Görüntülenme Sırası</label>
                                                <input type="text" class="form-control" value="{{ $corporate->queue }}"
                                                    name="queue">
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Durumu</label>
                                                <select class="form-control" name="status">
                                                    <option value="1" {{ $corporate->status == 1 ? 'selected' : '' }}>Aktif
                                                    </option>
                                                    <option value="0" {{ $corporate->status == 0 ? 'selected' : '' }}>Pasif
                                                    </option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Kapat</button>
                                            <button type="submit" class="btn btn-primary">Kaydet</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="modal" id="delete_{{ $corporate->id }}" tabindex="-1" role="dialog">
                            <form action="{{ route('admin.corporate_delete') }}" method="POST">
                                @csrf
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">İçeriği Sil</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{ $corporate->title }} içeriğini silmek istediğinize emin misiniz?</p>
                                        </div>
                                        <input type="hidden" name="id" value="{{ $corporate->id }}">
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-warning">Sil</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Vazgeç</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endforeach



                    <div class="modal fade" id="{{ $data['button']['id'] }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form action="{{ route('admin.corporate_add') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Kurumsal İçerik Ekle</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="title" class="col-form-label">Başlık</label>
                                                <input type="text" class="form-control" name="title" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="subtitle" class="col-form-label">Alt Başlık</label>
                                                <input type="text" class="form-control" name="subtitle">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">Tanımlayıcı(URL Başlığı)<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="slug" name="slug" required />
                                            <small class="form-text text-muted">
                                                Not: Bu alan diller arasında ortak bir anahtardır (ID). Aynı içeriğin
                                                farklı dilleri için aynı id kullanılmalıdır</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="lang_code" class="col-form-label">Dil</label>
                                            <select name="lang_code" class="form-control" required>
                                                @foreach ($languages as $lang)
                                                    <option value="{{ $lang->code }}">{{ $lang->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">İçerik</label>
                                            <textarea name="content" class="summernote" required></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="recipient-name" class="col-form-label">Kapak
                                                    Resmi</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image"
                                                        id="customFile" required>
                                                    <label class="custom-file-label" for="customFile">Resim
                                                        Seçiniz</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="recipient-name" class="col-form-label">Döküman</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="docname"
                                                        required>
                                                    <label class="custom-file-label" for="customFile">Döküman
                                                        Seçiniz</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Görüntülenme
                                                Sırası</label>
                                            <input type="text" class="form-control" name="queue" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Durumu</label>
                                            <select class="form-control" name="status">
                                                <option value="1">
                                                    Aktif
                                                </option>
                                                <option value="0">
                                                    Pasif
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Kapat</button>
                                        <button type="submit" value="submit" class="btn btn-primary">Kaydet</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </tbody>
            </table>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Body-->
    @if ($corporates->lastPage() > 1)
        <div class="card-footer">
            {{ $corporates->links('backend.modules.global.paginator', ['paginator' => $corporates]) }}
        </div>
    @endif
</div>
@section('js')
    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 150
            });
        });

        var editPrevImage = function (event, id) {
            var output = document.getElementById('edit_corporate_image_' + id);
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
@endsection