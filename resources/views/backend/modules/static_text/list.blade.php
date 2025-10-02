@if (session()->has('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session()->has('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card card-custom">
  <!--begin::Header-->
  <div class="card-header border-0 py-5">
    <h3 class="card-title align-items-start flex-column">
      <span class="card-label font-weight-bolder text-dark">Statik Metinler</span>
      <span class="text-muted mt-3 font-weight-bold font-size-sm">Aşağıda statik metinleri görebilirsiniz.</span>
    </h3>
  </div>
  <!--end::Header-->
  <!-- Body -->
  <div class="card-body py-0">
    <div class="table-responsive">
      <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
        <thead>
          <tr class="text-left">
            <th style="max-width: 30px">ID</th>
            <th style="min-width: 150px">Anahtar</th>
            <th style="min-width: 200px">Tanım</th>
            <th style="min-width: 200px">Değer</th>
            <th style="min-width: 20px">Dil Kodu</th>
            <th class="pr-0 text-right" style="min-width: 160px">İşlemler</th>
          </tr>
        </thead>
        <tbody>
          @foreach($static_texts as $text)
            <tr>
              <td>#{{ $text->id }}</td>
              <td>
                <span class="text-dark-75 font-weight-bolder">{{ $text->key }}</span>
              </td>
              <td>
                <span class="text-dark-75">{{ $text->label }}</span>
              </td>
              <td>
                <span class="text-dark-75">{{ $text->value }}</span>
              </td>
              <td>
                <span class="badge badge-light-primary font-weight-bolder">
                  {{ strtoupper($text->lang_code) }}
                </span>
              </td>
              <td class="pr-0 text-right">
                {{-- Düzenle --}}
                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="modal"
                  data-target="#modal_edit_{{ $text->id }}">
                  <i class="fa fa-edit"></i>
                </a>
                {{-- Sil --}}
                <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="modal"
                  data-target="#modal_delete_{{ $text->id }}">
                  <i class="fa fa-trash"></i>
                </a>
              </td>
            </tr>

            {{-- Düzenleme Modal --}}
            <div class="modal fade" id="modal_edit_{{ $text->id }}" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <form action="{{ route('admin.static_text_update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $text->id }}">
                    <div class="modal-header">
                      <h5 class="modal-title">Metni Düzenle</h5>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Anahtar</label>
                        <input type="text" name="key" value="{{ $text->key }}" class="form-control" disabled>
                      </div>
                      <div class="form-group">
                        <label>Tanım</label>
                        <input type="text" name="label" value="{{ $text->label }}" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Değer</label>
                        <textarea type="text" class="summernote" id="kt_summernote_1" name="value">{{ $text->value }}</textarea>
                      </div>
                      <div class="form-group">
                        <label>Dil</label>
                        <select name="lang_code" class="form-control">
                          @foreach($languages as $lang)
                            <option value="{{ $lang->code }}" {{ $lang->code == $text->lang_code ? 'selected' : '' }}>
                              {{ $lang->name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                      <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            {{-- Silme Modal --}}
            <div class="modal fade" id="modal_delete_{{ $text->id }}" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="{{ route('admin.static_text_delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $text->id }}">
                    <div class="modal-header">
                      <h5 class="modal-title">Metni Sil</h5>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <p>{{ $text->label ?: $text->key }} silinsin mi?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                      <button type="submit" class="btn btn-danger">Sil</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          @endforeach

          <div class="modal fade" id="{{ $data['button']['id'] }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="{{ route('admin.static_text_add') }}" method="POST">
              @csrf
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Metin Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="slug" class="col-form-label">Anahtar</label>
                      <input type="text" class="form-control" id="key" name="key" />
                    </div>
                    <div class="form-group">
                      <label for="label" class="col-form-label">Tanım</label>
                      <input type="text" class="form-control" name="label" required>
                    </div>
                    <div class="form-group">
                      <label for="value" class="col-form-label">Değer</label>
                      <textarea type="text" class="summernote" id="kt_summernote_1" name="value"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="lang_code" class="col-form-label">Dil</label>
                      <select name="lang_code" class="form-control" required>
                        @foreach ($languages as $lang)
                          <option value="{{ $lang->code }}">{{ $lang->name }}</option>
                        @endforeach
                      </select>
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
        </tbody>
      </table>
    </div>
  </div>

  @if($static_texts->lastPage() > 1)
    <div class="card-footer">
      {{ $static_texts->links('backend.modules.global.paginator', ['paginator' => $static_texts]) }}
    </div>
  @endif
</div>


</div>
</div>

@section('js')
  <script>
    $('.summernote').summernote({ minHeight: 200 });
  </script>
@endsection