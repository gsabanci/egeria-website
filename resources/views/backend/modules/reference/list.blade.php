@if (session()->has('success'))
<div class="alert alert-success" role="alert">
  {{session('success')}}
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger" role="alert">
  {{session('error')}}
</div>
@endif
<div class="card card-custom">
  <!--begin::Header-->
  <div class="card-header border-0 py-5">
    <h3 class="card-title align-items-start flex-column">
      <span class="card-label font-weight-bolder text-dark">Referanslar</span>
      <span class="text-muted mt-3 font-weight-bold font-size-sm">Aşağıda sistemde yer alan tüm referansları ve referans
        sayfası ayarlarını
        görebilirsiniz.</span>
    </h3>
  </div>
  <!--end::Header-->
  <!--begin::Body-->
  <!-- Success GELİCEK-->

  <div class="card-body py-0">
    <!--begin::Table-->
    <div class="table-responsive">

      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
            aria-controls="nav-home" aria-selected="true">İçerik</a>
          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
            aria-controls="nav-profile" aria-selected="false">Referans Ekle</a>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <form action="{{ route('admin.reference_page_text_update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mt-5">
              <input type="hidden" value="{{ $reference_page->reference_page_guid }}" name="reference_page_guid">
              <label for="inputEmail4">1. Başlık</label>
              <input type="text" name="first_title" value="{{ $reference_page->first_title }}" class="form-control">
            </div>
            <div class="form-group">
              <label for="inputPassword4">1. Başlık Altyazı</label>
              <textarea id="kt_summernote_2" class="summernote" type="text" name="first_title_subtitle"
                class="form-control">{!! $reference_page->first_title_subtitle !!}</textarea>
            </div>
            <div class="form-group">
              <label>2. Yazı</label>
              <textarea class="summernote" name="second_subtitle"
                id="kt_summernote_1">{!!  $reference_page->second_subtitle !!}</textarea>
            </div>
            <div class="mb-3">
              <button type="submit" class="btn btn-primary">Kaydet</button>
              <a href="{{ url()->previous() }}" class="btn btn-secondary ml-2">Geri</a>
            </div>
          </form>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
              <thead>
                <tr class="text-left">
                  <th style="max-width: 10px">ID</th>
                  <th style="min-width: 200px">Logo</th>
                  <th style="min-width: 200px">Referans Adı</th>
                  <th style="min-width: 50">Görüntülenme Sırası</th>
                  <th style="min-width: 120px">Durumu</th>
                  <th class="pr-0 text-right" style="min-width: 160px">İşlemler</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($references as $r)
                <tr>
                  <td>#{{ $loop->iteration }}</td>
                  <td>
                    <img src="{{ asset('storage/reference_images/'.$r->logo) }}" width="90">
                  </td>
                  <td>
                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $r->name }}</span>
                    <span class="text-muted font-weight-bold"></span>
                  </td>
                  <td>{{ !is_null($r->queue) ? $r->queue : 'Belirlenmemiş' }}</td>
                  <td>
                    @if($r->is_active == '1')
                    <span class="label label-lg label-light-success label-inline">Aktif</span>
                    @else
                    <span class="label label-lg label-light-danger label-inline">Pasif</span>
                    @endif
                  </td>
                  <td class="pr-0 text-right">

                    <a href="#" data-toggle="modal" data-target="#delete_{{ $r->reference_guid }}"
                      class="btn btn-icon btn-light btn-hover-primary btn-sm">
                      <span class="svg-icon svg-icon-md svg-icon-primary">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Trash.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                          height="24px" viewBox="0 0 24 24" version="1.1">
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
                <div class="modal" id="delete_{{ $r->reference_guid }}" tabindex="-1" role="dialog">
                  <form action="{{ route('admin.reference_delete') }}" method="POST">
                    @csrf
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Referans Sil</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>{{ $r->name }} adlı referansı silmek istediğinize emin misiniz?</p>
                        </div>
                        <input type="hidden" name="reference_guid" value="{{ $r->reference_guid }}">
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-warning">Sil</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                @endforeach
              </tbody>


          </div>
          </table>
        </div>
      </div>
    </div>
    <div class="modal fade" id="{{ $data['button']['id'] }}" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form action="{{ route('admin.reference_add') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Referans Ekle</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <div class="ref-logo-prev-bg">
                  <img src="" id="previewBox" class="ref-logo-prev-img">
                </div>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Referans Başlığı</label>
                <input type="text" class="form-control" name="name">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Logo</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="logo" id="inputGroupFile01" onchange="previewImg(event)">
                  <label class="custom-file-label" for="inputGroupFile01">Dosya seçin</label>
                </div>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Link</label>
                <input type="text" class="form-control" name="link">
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Durumu</label>
                <select class="form-control" name="is_active">
                  <option value="1">Aktif</option>
                  <option value="0">Pasif</option>
                </select>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Görüntüleme Sırası</label>
                <input type="text" class="form-control" name="queue">
              </div>
              <div class="form-group">
                <label class="checkbox">
                  <input type="checkbox" name="bad_logo" onclick="switchLogoStyle(event)">
                  <span style="margin-right: 6px"></span> Logoyu düzenle?
                </label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
              <button type="submit" value="submit" class="btn btn-primary">Kaydet</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
</div>
<!--end::Table-->
</div>
<!--end::Body-->

</div>
@section('js')
<script>
  var KTSummernoteDemo = function () {
 // Private functions
 var demos = function () {
  $('.summernote').summernote({
   height: 150
  });
 }

 return {
  // public functions
  init: function() {
   demos();
  }
 };
}();

// Initialization
jQuery(document).ready(function() {
 KTSummernoteDemo.init();
});

</script>
<script>
  var KTSummernoteDemo1 = function () {
 // Private functions
 var demos = function () {
  $('.summernote').summernote({
   height: 150
  });
 }

 return {
  // public functions
  init: function() {
   demos();
  }
 };
}();

// Initialization
jQuery(document).ready(function() {
 KTSummernoteDemo.init();
});


var previewImg = function(event) {
    var output = document.getElementById('previewBox');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
};

var switchLogoStyle = function(event) {
  if(event.target.checked) {
    $('#previewBox').addClass('badimg');
  } else {
    $('#previewBox').removeClass('badimg');
  }
}

</script>

@endsection