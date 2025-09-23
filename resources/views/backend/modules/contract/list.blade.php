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
            <span class="card-label font-weight-bolder text-dark">Sözleşmeler</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">Aşağıda site içi kullanıcı sözleşmelerini
                görebilirsiniz.</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
                <thead>
                    <tr class="text-left">
                        <th style="max-width: 30px">Tanımlayıcı(URL Başlığı)</th>
                        <th style="min-width: 300px">Ayar Adı</th>
                        <th style="min-width: 200px">Dil Kodu</th>
                        <th class="pr-0 text-right" style="min-width: 160px">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($policies as $s)
                        <tr>
                            <td>{{ $s->slug }}</td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $s->title }}</span>
                            </td>
                            <td class="font-weight-bolder">{{ strtoupper($s->lang_code) }}</td>
                            <td class="pr-0 text-right">
                                <a href="#" data-toggle="modal" data-target="#modal_{{ $s->policy_guid }}"
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
                            </td>
                        </tr>
                        <div class="modal fade" id="modal_{{ $s->policy_guid }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $s->title }} Düzenle
                                            [{{ strtoupper($s->lang_code) }}]</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.policy_update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body ">
                                            <div class="row">
                                                 <div class="form-group col-12">
                                                    <label for="recipient-name" class="col-form-label">Başlık</label>
                                                    <input type="text" class="form-control" value="{{ $s->slug }}"
                                                        name="slug">
                                                    <input type="hidden" name="policy_guid" value="{{ $s->policy_guid }}">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label for="recipient-name" class="col-form-label">Başlık</label>
                                                    <input type="text" class="form-control" value="{{ $s->title }}"
                                                        name="title">
                                                    <input type="hidden" name="policy_guid" value="{{ $s->policy_guid }}">
                                                </div>
                                                <div class="form-group col-12">
                                                    <label for="recipient-name" class="col-form-label">İçerik</label>
                                                    <textarea type="text" class="summernote"
                                                        name="content">{{ $s->content }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Kapat</button>
                                            <button type="submit" value="submit" class="btn btn-primary">Kaydet</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    <div class="modal fade" id="{{ $data['button']['id'] }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form action="{{ route('admin.policy_add') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Sözleşme Ekle</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Tanımlayıcı(URL Başlığı)</label>
                                            <input type="text" class="form-control" name="slug">
                                            <small class="form-text text-muted">
                                                Not: Bu alan diller arasında ortak bir anahtardır (ID gibi). Aynı içeriğin farklı dilleri için aynı slug kullanılmalıdır</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Sözleşme Adı</label>
                                            <input type="text" class="form-control" name="title">
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
                                            <label for="value" class="col-form-label">İçerik</label>
                                            <textarea type="text" class="summernote" id="kt_summernote_1"
                                                name="content"></textarea>
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
    {{-- @if($staffs->lastPage() > 1)
    <div class="card-footer">
        {{ $staffs->links('backend.modules.global.paginator', ['paginator' => $staffs]) }}
    </div>
    @endif --}}
</div>